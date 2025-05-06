<x-app-layout>
    @section('main-content')
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-3 ms-4">Wishlist</h3>
            </div>

        </div>
        <div class="row mt-4">
            <input type="hidden" id="wishlistPage" value="{{ true }}">
            @if (count($wishlists) > 0)
                @foreach ($wishlists as $wishlist)
                    <div class="products_list_box text-center">
                        <div class="col-3 ms-5 mb-4 position-relative">
                            <!-- Trash Button (styled) -->
                            <a href="{{ route('wishlist.destroy', $wishlist->id) }}"
                                class=" wishlist wishlist-delete-btn position-absolute top-0 end-0 p-2 bg-danger text-white"
                                title="Remove from wishlist"
                                onclick="return confirm('Are you sure to delete the item from Wishlist')">
                                <i class="fas fa-trash"></i> <!-- You can also use '&times;' here -->
                            </a>

                            <!-- Product Card -->
                            <x-product-card :product="$wishlist->product" />
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12 text-center">
                    <p>Wishlists is empty</p>
                </div>
            @endif

        </div>

    @endsection
</x-app-layout>
