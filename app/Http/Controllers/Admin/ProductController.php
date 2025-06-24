<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Midhas;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductFinance;
use App\Models\Product\ProductManual;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductVariant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $folder = 'products/';

    public function __construct(public Product $product) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request()->type;
        $searchColumns = ['id', 'title', 'sku', 'upc_code', 'status'];
        $search = request()->search;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;
        $type = request()->type;

        $query = $this->product->category();
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $products = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());

        return view('admin.products.index', compact('products', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->all();
            $data['slug'] = Str::slug($data['title'], '-');

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] =  Midhas::upload($request->thumbnail, $this->folder . '/thumbnails/');
            }
            $data['stock_balance'] = $request->total_stock ?? 0;
            $data['is_taxable'] = isset($request->is_taxable) ? true : false;

            $product = $this->product->create($data);
            $this->addCategories($product, $request);
            $this->addPrices($product, $request);
            $this->addSettings($product, $request);
            $this->uploadImages($product, $request);
            $this->addStocks($product, $request);
            $this->addVariants($product, $request);
            $this->addSpecifications($product, $request);
            $this->addManuals($product, $request);
            $this->addFinancing($product, $request);

            //add seo contest
            Midhas::addSeo($product, request()->only(['meta_title', 'meta_description', 'meta_keywords']));
            DB::commit();
            return to_route('admin.products.index')->with('success', 'Product added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        DB::beginTransaction();

        try {

            $product = $this->product->find($id);

            $data = $request->all();

            $data['slug'] = Str::slug($data['title'], '-');

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] =  Midhas::upload($request->thumbnail, $this->folder . '/thumbnails/');
            } else {
                $data['thumbnail'] = $product->getRawOriginal('thumbnail');
            }

            $data['stock_balance'] = $request->total_stock ?? 0;
            $data['is_taxable'] = isset($request->is_taxable) ? true : false;

            $product->update($data);
            $this->addCategories($product, $request);
            $this->addPrices($product, $request);
            $this->addSettings($product, $request);
            $this->uploadImages($product, $request);
            $this->addStocks($product, $request);
            $this->addVariants($product, $request);
            $this->addSpecifications($product, $request);
            $this->addManuals($product, $request);
            $this->addFinancing($product, $request);

            //add seo contest
            Midhas::addSeo($product, request()->only(['meta_title', 'meta_description', 'meta_keywords']), $product->seo?->id);

            DB::commit();

            return to_route('admin.products.index')->with('success', 'Product added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = request()->type;
        $selectedItems = request()->selectedIds;
        $status = request()->status;

        foreach ($selectedItems as $item) {
            $product = $this->product->find($item);
            if ($type == 1) {
                $product->delete();
            } else if ($type == 2) {
                $product->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function addCategories($product, $request): void
    {
        if (isset($request->categories) && count($request->categories) > 0) {
            $product->categories()->sync($request->categories);
        }
    }


    public function addPrices($product, $request): void
    {
        $ids = $request->promo_id;
        $deleted_ids = json_decode($request->deleted_prices);

        $amounts = $request->amount;
        $start_dates = $request->start_date;
        $end_dates = $request->end_date;

        if ($deleted_ids && count($deleted_ids) > 0) {
            foreach ($deleted_ids as $id) {
                ProductPrice::find($id)->delete();
            }
        }

        if ($amounts && $start_dates && $end_dates) {
            foreach ($amounts as $key => $amount) {
                if ($amounts[$key] > 0 && (isset($start_dates[$key]) && $start_dates[$key] != '') && (isset($end_dates[$key]) && $end_dates[$key] != '')) {
                    if (is_null($ids[$key])) {
                        $product->prices()->create([
                            'start_date' => $start_dates[$key],
                            'end_date' => $end_dates[$key],
                            'price' => $amounts[$key]
                        ]);
                    } else {
                        ProductPrice::find($ids[$key])->update([
                            'start_date' => $start_dates[$key],
                            'end_date' => $end_dates[$key],
                            'price' => $amounts[$key]
                        ]);
                    }
                }
            }
        }
    }

    public function addSettings($product, $request): void
    {
        $settings = [
            'is_new',
            'is_featured',
            'is_best_selling',
            'is_top_rated',
            'is_taxable',
            'is_outof_stock',
            'is_comming'
        ];

        $data = [];

        foreach ($settings as $setting) {
            $data[$setting] = in_array($setting, $request->settings ?? []) ? true : false;
        }

        $product->update($data);
    }

    public function uploadImages($product, $request): void
    {
        $images = $request->product_images;

        if ($images && count($images) > 0) {
            foreach ($images as $key => $image) {
                $url = Midhas::upload($image, $this->folder . $product->id . '/');
                $product->images()->create([
                    'url' => $url,
                ]);
            }
        }
    }

    public function addStocks($product, $request): void
    {
        //stocks 
        $ids = $request->stock_id;
        $deleted_ids = json_decode($request->deleted_stocks);

        $stores = $request->stores;
        $stocks = $request->stock;

        if ($deleted_ids && count($deleted_ids) > 0) {
            foreach ($deleted_ids as $id) {
                ProductStock::find($id)->delete();
            }
        }

        if ($stores && count($stores) > 0) {
            foreach ($stores as $key => $store) {
                if ($stores[$key] && $stores[$key] != '') {
                    if (is_null($ids[$key])) {
                        $product->stocks()->create([
                            'store_id' => $stores[$key],
                            'stock' => $stocks[$key],
                            'balance' => $stocks[$key]
                        ]);
                    } else {
                        ProductStock::find($ids[$key])->update([
                            'store_id' => $stores[$key],
                            'stock' => $stocks[$key],
                            'balance' => $stocks[$key]
                        ]);
                    }
                }
            }
        }
    }


    public function addVariants($product, $request)
    {
        $ids = $request->variant_id;
        $deleted_ids = json_decode($request->deleted_variants);

        $variants = $request->variant_type_id;
        $values = $request->variant_value;
        $prices = $request->variant_price;
        $stocks = $request->variant_stock;
        $images = $request->variant_files;

        if ($deleted_ids && count($deleted_ids) > 0) {
            foreach ($deleted_ids as $id) {
                ProductVariant::find($id)->delete();
            }
        }

        if ($variants && count($variants) > 0) {
            foreach ($variants as $key => $variant) {
                if ($variants[$key] && $variants[$key] != '') {
                    $url = null;
                    if (is_null($ids[$key])) {
                        if ($images[$key]) {
                            $url = Midhas::upload($images[$key], $this->folder . $product->id . "/variants/");
                        }
                        $product->variants()->create([
                            'variant_id' => $variants[$key],
                            'value' => $values[$key],
                            'price' => $prices[$key],
                            'stock' => $stocks[$key],
                            'thumbnail' => $url
                        ]);
                    } else {
                        $existingVariant = ProductVariant::find($ids[$key]);

                        if (isset($images[$key]) && $images[$key]) {
                            $url = Midhas::upload($images[$key], $this->folder . $product->id . "/variants/");
                        } else {
                            $url = $existingVariant->thumbnail;
                        }

                        $existingVariant->update([
                            'variant_id' => $variants[$key],
                            'value' => $values[$key],
                            'price' => $prices[$key],
                            'stock' => $stocks[$key],
                            'thumbnail' => $url
                        ]);
                    }
                }
            }
        }
    }

    public function addSpecifications($product, $request): void
    {
        $specifications = $request->specifications ?? [];

        foreach ($specifications as $specification_id => $value) {
            if (!is_null($value) && $value !== '') {
                $existing = $product->specifications()->where('specification_id', $specification_id)->first();

                if ($existing) {
                    $existing->update(['value' => $value]);
                } else {
                    $product->specifications()->create([
                        'specification_id' => $specification_id,
                        'value' => $value
                    ]);
                }
            } else {
                // Delete if empty
                $product->specifications()->where('specification_id', $specification_id)->delete();
            }
        }
    }

    public function addManuals($product, $request): void
    {
        $names = $request->manual_label;            // array
        $files = $request->file('manual_files');    // uploaded files
        $links = $request->manual_file_link;        // array
        $ids = $request->manual_ids;                // array of IDs
        $deleted_ids = json_decode($request->deleted_manual_ids);

        // 1. Delete manuals by ID
        if ($deleted_ids && is_array($deleted_ids)) {
            ProductManual::whereIn('id', $deleted_ids)->delete();
        }

        // 2. Process incoming manuals
        if ($names && count($names) > 0) {
            foreach ($names as $index => $name) {
                if (!$name) continue;

                $id = $ids[$index] ?? null;
                $file = $files[$index] ?? null;
                $link = $links[$index] ?? null;
                $filePath = null;

                // Upload file if available
                if ($file) {
                    $filePath = Midhas::upload($file, $this->folder . $product->id . "/manuals/");
                }

                if ($id) {
                    // Update existing manual
                    $manual = ProductManual::find($id);
                    if (!$manual) continue;

                    if (!$filePath && $manual->uploaded_file) {
                        $filePath = $manual->uploaded_file; // Keep existing file
                    }

                    $manual->update([
                        'name' => $name,
                        'uploaded_file' => $filePath,
                        'file_link' => $link,
                    ]);
                } else {
                    // Create new manual
                    $product->manuals()->create([
                        'name' => $name,
                        'uploaded_file' => $filePath,
                        'file_link' => $link,
                    ]);
                }
            }
        }
    }

    public function addFinancing($product, $request): void
    {
        //financing
        $ids = $request->financing_multiple_item_ids;
        $names = $request->financing_name;
        $no_of_months = $request->financing_no_of_months;
        $interest_per_month = $request->financing_interest_per_month;
        $financing_fee = $request->financing_fee;

        if ($names && count($names) > 0) {
            foreach ($names as $key => $name) {
                $id = $ids && isset($ids[$key]) && !is_null($ids[$key]);
                if ($names[$key] != '' && $no_of_months[$key] && $interest_per_month[$key] != '') {
                    if ($id) {
                        ProductFinance::find($ids[$key])->update([
                            'name' => $names[$key],
                            'no_of_months' => $no_of_months[$key],
                            'interest_per_month' => $interest_per_month[$key],
                            'price' => $financing_fee[$key]
                        ]);
                    } else {
                        $product->finances()->create([
                            'name' => $names[$key],
                            'no_of_months' => $no_of_months[$key],
                            'interest_per_month' => $interest_per_month[$key],
                            'price' => $financing_fee[$key]
                        ]);
                    }
                }
            }
        }
    }

    public function updatePrice(Request $request)
    {
        $ids = $request->ids;
        $amounts = $request->amount;
        $start_dates = $request->start_date;
        $end_dates = $request->end_date;

        if ($ids) {
            foreach ($ids as $key => $id) {
                ProductPrice::find($id)->update([
                    'start_date' => $start_dates[$key],
                    'end_date' => $end_dates[$key],
                    'price' => $amounts[$key]
                ]);
            }
        }
        return redirect()->back()->with('success', 'Price updated successfully');
    }
}
