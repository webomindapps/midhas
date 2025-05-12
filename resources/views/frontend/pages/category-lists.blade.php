<x-frontend.page>

    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li><a href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a></li>
            </ul>
        </div>
    </section>
    <section class="section listing_wrapper w-100">
        <div class="container text-start">
            <div class="col-12 d-flex sm-flex-column">
                <x-product-filter :subcategories="$sub_categories" :filters="$filters ?? []" :brands="$brands ?? []" />
                <div class="products_list_box text-center">
                    @forelse ($products as $product)
                        <div class="item">
                            <x-product-card :product="$product" />
                        </div>
                    @empty
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <div class="item empty"></div>
                        <p>No products available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <section class="section sellers bg-light">
        <div class="container text-center">
            <h2 class="sec_title text_inter text-uppercase fw-normal">Recently <span class="fw-bold">viewed items</span>
            </h2>
            <div class="col-12 mt-5">
                <div class="row product_wrap">
                    @foreach ($recentlyViewed as $recents)
                        <div class="col-3">
                            <x-product-card :product="$recents" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-frontend.page>
