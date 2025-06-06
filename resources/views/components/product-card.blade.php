@props(['product'])

<div class="product_box">
    <a href="{{ route('productByCategory', $product->slug) }}">
        <div class="prd_img">
            <img src="{{ $product->thumbnail }}" alt="{{ $product->title }}" class="w-100 img-fluid"
                id="product-image-{{ $product->id }}">
        </div>
    </a>
    <div class="color_selector d-flex justify-content-center">
        @foreach ($product->variants as $variant)
            <span style="--color: {{ $variant->value }};" class="color-variant"
                data-variant-image="{{ asset('storage/' . $variant->thumbnail) }}"
                data-variant-name="{{ $variant->variant->name }}" data-product-id="{{ $product->id }}"
                data-stock="{{ $product->total_stock }}"></span>
        @endforeach
    </div>
    <h3 class="prd_name
                text_hind fw-bold">{{ $product->title }}</h3>
    <div class="row">
        <span class="prd_price fw-bold d-block">${{ number_format($product->msrp ?? 0, 2) }}</span>
    </div>

    <div class="d-flex text_inter prd_actions">
        @if ($product->isEnquiry())
            <div class="w-100 text-center text-uppercase fw-bold">
                <a href="{{ route('productByCategory', $product->slug) }}"
                    class="view d-block w-100 text-uppercase fw-bold text-center"
                    style="background-color: rgb(255, 0, 0); color: white;">
                    Out Of Stock
                </a>
            </div>
        @else
            @if ($product->total_stock > 0 && !$product->is_outof_stock)
                <div class="col">
                    <a class="addToCart buy d-block w-100 text-uppercase fw-bold text-center"
                        data-id="{{ $product->id }}">
                        Buy
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('productByCategory', $product->slug) }}"
                        class="view d-block w-100 text-uppercase fw-bold text-center">
                        View
                    </a>
                </div>
            @else
                <div class="stock-out w-100 text-center text-uppercase fw-bold">
                    <a href="{{ route('productByCategory', $product->slug) }}"
                        class="view d-block w-100 text-uppercase fw-bold text-center" data-id="{{ $product->id }}"
                        style="background-color: rgb(255, 0, 0); color: white;">
                        Out Of Stock
                    </a>
                </div>
            @endif
        @endif
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
