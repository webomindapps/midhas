<x-frontend.page>

    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
           <ul class="list_styled d-flex breadcrumb">
                <li><a href="{{ url('/') }}">Home <i class="fa-solid fa-chevron-right"></i></a></li>

                @php
                    $current = $category;
                    $breadcrumbs = collect();
                    while ($current) {
                        $breadcrumbs->prepend($current);
                        $current = $current->parent; // Assuming relationship 'parent' exists
                    }
                @endphp

                @foreach ($breadcrumbs as $cat)
                    <li>
                        <a href="{{ route('productByCategory', $cat->slug) }}">
                            {{ ucwords(strtolower($cat->name)) }}
                            @if (!$loop->last)
                                <i class="fa-solid fa-chevron-right"></i>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="section listing_wrapper w-100">
        <div class="container text-start">
            <div class="col-12 d-flex sm-flex-column mb-2">
                <div class="sidebar">
                    <input type="checkbox" value="0" id="outofstock"> Hide Out of Stock Products
                </div>
                <div class="products_list_box d-flex justify-content-between">
                    <p>{{ count($products) }} Items</p>
                    <div class="">
                        <div class="dropdown">
                            <a rel="nofollow" contenteditable="false" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by <strong><span class="selected_sort_order_label" id="selected_label">Relevance</span></strong>
                                <i class="fas fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu no-bullet" aria-labelledby="dropdownMenuLink">
                                <li class="sorting" data-column="title" data-sort="asc">
                                    Title A-Z
                                </li>
                                <li class="sorting" data-column="title" data-sort="desc">
                                    Title Z-A
                                </li>
                                <li class="sorting" data-column="selling_price" data-sort="asc">
                                    Price Low-High
                                </li>
                                <li class="sorting" data-column="selling_price" data-sort="desc">
                                    Price High-Low
                                </li>
                                <li class="sorting" data-column="created_at" data-sort="desc">
                                    Most Recent
                                </li>
                                {{-- <li class="sorting" data-column="price" data-sort="asc" data-value="name">
                                    <a href="?sort=13" class="" rel="nofollow" id="13"
                                        contenteditable="false" style="cursor: pointer;">
                                        Release Date </a>
                                </li>
                                <li class="sorting" data-column="price" data-sort="asc" data-value="name">
                                    <a href="?sort=39" class="" rel="nofollow" id="39"
                                        contenteditable="false" style="cursor: pointer;">
                                        Highest Rated </a>
                                </li> --}}
                                <li>Relevance</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex sm-flex-column">
                <x-product-filter :subcategories="$sub_categories" :filters="$filters ?? []" :brands="$brands ?? []" />
                <div class="products_list_box text-center">
                    @forelse ($products as $product)
                        <div class="item">
                            <x-product-card :product="$product" />
                        </div>
                    @empty
                        <p>No products available.</p>
                    @endforelse
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                    <div class="item empty"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="section sellers bg-light">
        <div class="container text-center">
            <h2 class="sec_title text_inter text-uppercase fw-normal">Recently <span class="fw-bold">viewed
                    items</span>
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
