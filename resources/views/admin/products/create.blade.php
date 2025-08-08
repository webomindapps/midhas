<x-page-content title="Add Product" isBack="{{ true }}">

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
            <form method="POST" class="formSubmit" action="{{ route('admin.products.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">

                    <x-forms.input label="Product Title" type="text" name="title" id="title" :required="true"
                        size="col-lg-3 mt-4" :value="old('title')" class="slug" />

                    <x-forms.input label="Slug" type="text" name="slug" id="slug" :required="true"
                        size="col-lg-3 mt-4" :value="old('slug')" />

                    <x-forms.input label="Product Sku" type="text" name="sku" id="sku" :required="true"
                        size="col-lg-3 mt-4" :value="old('sku')" />

                    <x-forms.input label="Product Upc" type="text" name="upc_code" id="upc_code" :required="false"
                        size="col-lg-3 mt-4" :value="old('upc_code')" />

                    <x-forms.select label="Brand" name="brand_id" id="brand_id" :required="false" size="col-lg-3 mt-4"
                        :options="Midhas::getBrands()" :value="old('brand_id', 1)" />

                    <x-forms.select label="Order Type" name="order_type" id="order_type" :required="true"
                        size="col-lg-3 mt-4" :options="Midhas::getOrderType()" :value="old('order_type', 1)" />

                </div>

                <x-accordion.group>
                    <x-accordion.item id="category" title="Category">
                        <div class="row">
                            <x-admin.category />

                        </div>
                    </x-accordion.item>
                    <x-accordion.item id="pricing" title="Pricing">
                        <div class="row">
                            <x-forms.input label="Selling Price" type="text" name="selling_price" id="selling_price"
                                :required="true" size="col-lg-3 mt-4" :value="old('selling_price')" class="price" />

                            <x-forms.input label="MSRP" type="text" name="msrp" id="msrp"
                                :required="true" size="col-lg-3 mt-4" :value="old('msrp')" class="price" />

                            <x-forms.input label="Instore Price" type="text" name="instore_price" id="instore_price"
                                :required="true" size="col-lg-3 mt-4" :value="old('instore_price')" class="price" />

                            <x-forms.input label="Rebate" type="text" name="rebate" id="rebate"
                                :required="true" size="col-lg-3 mt-4" :value="old('rebate')" class="price" />

                            <div class="col-lg-12 mt-4" id="admin-app-one">
                                <promo-price />
                            </div>
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="product-setting" title="Product Settings">
                        <x-admin.product-setting />
                    </x-accordion.item>

                    <x-accordion.item id="filters" title="Filters">
                        <x-admin.product-filter />
                    </x-accordion.item>

                    <x-accordion.item id="upload-images" title="Upload Images">
                        <div class="row">
                            <x-forms.input label="Product Thumbnail" type="file" name="thumbnail" id="thumbnail"
                                :required="false" size="col-lg-6 mt-4" :value="old('thumbnail')" class="image-file"
                                :image="true" />

                            <x-forms.input label="Product Images" type="file" name="product_images[]"
                                id="product_images" :required="false" size="col-lg-6 mt-4" :value="old('product_images')"
                                :multiple="true" class="image-file multiple-images" :image="true" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="stock" title="Stock">
                        <div class="row" id="admin-app-two">
                            <product-stock :stores="{{ Midhas::getStore() }}" />
                        </div>
                    </x-accordion.item>

                    <x-accordion.item id="variants" title="Variants">
                        <div class="row" id="admin-app-variants">
                            <product-variant :types="{{ Midhas::getVariants() }}" />
                        </div>
                    </x-accordion.item>
                    <x-accordion.item id="tv_sizes" title="Sizes">
                        <div class="row" id="admin-app-tv-size">
                            <tv-size :categories="{{ Midhas::getCategories() }}" />
                        </div>
                    </x-accordion.item>
                    <x-accordion.item id="accesories" title="Accessories">
                        <div class="row" id="admin-app-accessories">
                            <accessories />
                        </div>
                    </x-accordion.item>

                    <x-admin.seo-form />

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
                                        required size="col-lg-12" :editor="true" :value="old('product_details', $product->product_details ?? '')" />

                                    <x-forms.textarea label="Product Description" name="product_description"
                                        id="editor-3" required size="col-lg-12 mb-2" :editor="true"
                                        :value="old('product_description', $product->product_description ?? '')" />

                                    <x-forms.textarea label="Payment & Security" name="payment_security"
                                        id="editor-2" :editor="true"  size="col-lg-12"
                                        :value="old('payment_security', $product->payment_security ?? '')" />
                                </div>
                            </x-tabs.content>


                            <x-tabs.content id="specifications">
                                <x-admin.product-specification />
                            </x-tabs.content>

                            <x-tabs.content id="manuals">
                                <div class="row" id="admin-app-manuals">
                                    <multiple-item />
                                </div>
                            </x-tabs.content>
                            <x-tabs.content id="finance">
                                <div class="row">
                                    <div class="row" id="admin-app-financing">
                                        <finance-section />
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
</x-page-content>
