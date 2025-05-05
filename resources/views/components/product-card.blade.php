@props(['product'])

<div class="product_box">
    <a href="{{ route('productByCategory', $product->slug) }}">
        <div class="prd_img">
            <img src="{{ $product->thumbnail }}" alt="{{ $product->title }}" class="w-100 img-fluid"
                id="product-image-{{ $product->id }}">
    </a>
</div>
<div class="color_selector d-flex justify-content-center">
    @foreach ($product->variants as $variant)
        <span style="--color: {{ $variant->value }};" class="color-variant"
            data-variant-image="{{ asset('storage/' . $variant->thumbnail) }}"
            data-variant-name="{{ $variant->variant->name }}" data-product-id="{{ $product->id }}"></span>
    @endforeach
</div>
<h3 class="prd_name text_hind fw-bold">{{ $product->title }}</h3>
<div class="row">
    <span class="prd_price fw-bold d-block">${{ number_format($product->msrp ?? 0, 2) }}</span>
    {{-- <span> <x-qty-input :id="$product->id" /></span> --}}
</div>

<div class="d-flex text_inter prd_actions">
    <div class="col">
        @if ($product->total_stock > 0)
            <a class="addToCart buy d-block" data-id="{{ $product->id }}"> Buy
            </a>
        @else
            <p class="stock-out">
                <a class=" bg-danger text-white d-block w-100" data-id="{{ $product->id }}">
                    Out Of Stock
                </a>
            </p>
        @endif

        {{-- <a href="#" class="buy d-block">Buy</a> --}}
    </div>
    <div class="col">
        <a href="{{ route('productByCategory', $product->slug) }}" class="view d-block">View</a>
    </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const colorVariants = document.querySelectorAll('.color_selector span');

        function updateProductImage(productId, selectedColor) {
            const variantImage = selectedColor.getAttribute('data-variant-image');
            const productImage = document.getElementById('product-image-' + productId);
            productImage.src = variantImage;

            const variantName = selectedColor.getAttribute('data-variant-name');
            console.log('Selected Variant for Product ' + productId + ':', variantName);
        }


        colorVariants.forEach(color => {
            color.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productVariants = document.querySelectorAll(
                    `#product-${productId} .color_selector span`);
                productVariants.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                updateProductImage(productId, this);
            });
        });
        const activeColorVariants = document.querySelectorAll('.color-variant.active');
        activeColorVariants.forEach(activeColor => {
            const productId = activeColor.getAttribute('data-product-id');
            updateProductImage(productId, activeColor);
        });
    });
</script>
