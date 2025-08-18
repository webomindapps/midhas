<x-page-content title="Edit Product" isBack="{{ true }}">

    @php
        $category_ids = Midhas::getCategoriesBasedOnProduct($product);
    @endphp

    <div class="col-lg-12 py-4">
        <div class="form-card px-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="formSubmit" action="{{ route('admin.products.update', $product) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <x-forms.input label="Product Title" type="text" name="title" id="title" :required="true"
                        size="col-lg-3 mt-4" value="{!! $product->title !!}" class="slug" />
                    <input type="hidden" id="product_id" value="{{ $product->id }}">
                    <input type="hidden" id="product_category_ids" value="{{ json_encode($category_ids) }}">
                    <x-forms.input label="Slug" type="text" name="slug" id="slug" :required="true"
                        size="col-lg-3 mt-4" :value="$product->slug" />

                    <x-forms.input label="Product Sku" type="text" name="sku" id="sku" :required="true"
                        size="col-lg-3 mt-4" :value="$product->sku" />

                    <x-forms.input label="Product Upc" type="text" name="upc_code" id="upc_code" :required="false"
                        size="col-lg-3 mt-4" :value="$product->upc_code" />

                    <x-forms.select label="Brand" name="brand_id" id="brand_id" :required="false" size="col-lg-3 mt-4"
                        :options="Midhas::getBrands()" :value="$product->brand_id" />

                    <x-forms.select label="Order Type" name="order_type" id="order_type" :required="true"
                        size="col-lg-3 mt-4" :options="Midhas::getOrderType()" :value="$product->order_type" />
                </div>


                <x-accordion.group>
                    <x-accordion.item id="category" title="Category">
                        <div class="row">
                            <x-admin.category :existing="$category_ids" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="pricing" title="Pricing">
                        <div class="row">
                            <x-forms.input label="Selling Price" type="text" name="selling_price" id="selling_price"
                                :required="true" size="col-lg-3 mt-4" :value="$product->selling_price" class="price" />

                            <x-forms.input label="MSRP" type="text" name="msrp" id="msrp"
                                :required="true" size="col-lg-3 mt-4" :value="$product->msrp" class="price" />

                            <x-forms.input label="Instore Price" type="text" name="instore_price" id="instore_price"
                                :required="true" size="col-lg-3 mt-4" :value="$product->instore_price" class="price" />

                            <x-forms.input label="Rebate" type="text" name="rebate" id="rebate"
                                :required="true" size="col-lg-3 mt-4" :value="$product->rebate" class="price" />

                            <div class="col-lg-12 mt-4" id="admin-app-one">
                                <promo-price :existing="{{ $product->prices }}" />
                            </div>

                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="product-setting" title="Product Settings">
                        <x-admin.product-setting :existing="$product" />
                    </x-accordion.item>

                    <x-accordion.item id="filters" title="Filters">
                        <x-admin.product-filter :existing="$product" />
                    </x-accordion.item>
                    <x-accordion.item id="upload-images" title="Upload Images">
                        <div class="row">
                            <x-forms.input label="Product Thumbnail" type="file" name="thumbnail" id="thumbnail"
                                :required="false" size="col-lg-6 mt-4" :value="$product->thumbnail" class="image-file"
                                :image="true" imageValue="{{ $product->thumbnail }}" />

                            <x-forms.input label="Product Images" type="file" name="product_images[]"
                                id="product_images" :required="false" size="col-lg-6 mt-4" :value="$product->product_images"
                                :multiple="true" class="image-file multiple-images" :image="true" />

                            <x-admin.product-images :items="$product->images" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="stock" title="Stock">
                        <div class="row" id="admin-app-two">
                            <product-stock :stores="{{ Midhas::getStore() }}" :stock="{{ $product->total_stock }}"
                                :existing="{{ $product->stocks }}" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="variants" title="Variants">
                        <div class="row" id="admin-app-variants">
                            <product-variant :types="{{ Midhas::getVariants() }}"
                                :existing="{{ $product->variants }}" />
                        </div>
                    </x-accordion.item>
                    <x-accordion.item id="tv_sizes" title="Sizes">
                        <div class="row" id="admin-app-tv-size">
                            <tv-size :categories="{{ Midhas::getCategories() }}"
                                :existing="{{ $product->sizes }}" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="accesories" title="Accessories">
                        <div class="row" id="admin-app-accessories">
                            <accessories :categories="{{ Midhas::getCategories() }}"
                                :existing="{{ $product->accessories }}" />
                        </div>
                    </x-accordion.item>

                    <x-admin.seo-form :existing="$product->seo" />

                </x-accordion.group>

                <div class="col-md-12 specification">
                    <div class="col-md-12 specs">
                        <x-tabs.section id="products">
                            <x-slot:heading>
                                <x-tabs.item id="descriptions" title="Overview" is_active="{{ true }}" />
                                <x-tabs.item id="specifications" title="Specifications" />
                                <x-tabs.item id="manuals" title="Assembly Manuals" />
                                <x-tabs.item id="finance" title="Financing" />
                            </x-slot>

                            <x-tabs.content id="descriptions" is_active="{{ true }}">
                                <div class="row">
                                    <x-forms.textarea label="Product Details" name="product_details" id="editor-1"
                                        :required="true" size="col-lg-12" :value="$product->product_details" :editor="true" />

                                    <x-forms.textarea label="Product Description" name="product_description"
                                        id="editor-3" :required="true" size="col-lg-12 mb-2" :value="$product->product_description"
                                        :editor="true" />

                                    <x-forms.textarea label="Payment & security" name="payment_security"
                                        id="editor-2" :editor="true" :required="true" size="col-lg-12"
                                        :value="$product->payment_security" />
                                </div>
                            </x-tabs.content>

                            <x-tabs.content id="specifications">
                                <x-admin.product-specification :existing="$product->specifications" />
                            </x-tabs.content>

                            <x-tabs.content id="manuals">
                                <div class="row" id="admin-app-manuals">
                                    <multiple-item :existing="{{ json_encode($product->manuals) }}" />
                                </div>
                            </x-tabs.content>
                            <x-tabs.content id="finance">
                                <div class="row">
                                    <div class="row" id="admin-app-financing">
                                        <finance-section :existing="{{ json_encode($product->finances) }}" />
                                    </div>
                                </div>
                            </x-tabs.content>
                        </x-tabs.section>
                    </div>
                </div>

                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            $(document).on('click', '.prd-Image-delete', function() {
                if (confirm('Are you sure you want to delete this?')) {
                    var id = $(this).data('id')
                    var url = $(this).data('url')

                    $.ajax({
                        url,
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id,
                        },
                        success: function(data) {
                            if (data.success) {
                                $(`#prd-section-${id}`).remove()
                            }
                        }
                    })
                }

            })
        </script>
    </x-slot:scripts>

</x-page-content>
