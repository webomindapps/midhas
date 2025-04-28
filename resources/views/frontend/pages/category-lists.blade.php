<x-app-layout>
    @section('main-content')
        <section class="section breadcrumb pb-0 seo_content w-100">
            <div class="container text-start">
                <ul class="list_styled d-flex breadcrumb mb-5">
                    <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                    <li><a href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a></li>
                </ul>

                <h2 class="text_inter text-uppercase">{{ $category->name }}</h2>
                <p class="text_inter mb-0">Create a relaxing and inviting atmosphere with our stylish, affordable living room
                    furniture selection. Whether you want to create a fun, entertaining space with sociable seating and the
                    perfect TV stand for film nights or a relaxation retreat with lamp tables for soft lighting and for your
                    cuppa, there’s something for everyone at Big Furniture Warehouse. Create a modern, clean aesthetic with
                    white and grey lounge furniture or a more rustic feel with natural wood furniture and bring your vision
                    to life.</p>
            </div>
        </section>
        <section class="section listing_wrapper w-100">
            <div class="container text-start">
                <div class="col-12 d-flex sm-flex-column">
                    <x-product-filter :subcategories="$sub_categories" :cat="$category" />

                    @forelse ($products as $product)
                        <div class="products_list_box text-center">
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
    @endsection
</x-app-layout>
