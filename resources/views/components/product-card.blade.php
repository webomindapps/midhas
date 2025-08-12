@props(['product'])

<div class="product_box">
    @if (count($product->variants) > 0 || count($product->sizes) > 0)
        <div class="variant-hov">
            @if (count($product->variants) > 0)
                <div class="product__details__holder__quick-view__group">
                    <span class="product__details__holder__quick-view__group__subtitle">
                        Colour
                    </span>
                    <ul class="product__details__holder no-bullet">
                        @foreach ($product->variants as $variant)
                            <li>
                                <a href="{{ route('productByCategory', $product->slug) }}"> {{ $variant->value }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (count($product->sizes) > 0)
                <div class="product__details__holder__quick-view__group">
                    <span class="product__details__holder__quick-view__group__subtitle">
                        Size
                    </span>
                    <ul class="product__details__holder no-bullet">
                        @foreach ($product->sizes as $size)
                            <li>
                                <a href="{{ route('productByCategory', $size->product?->slug) }}">
                                    {{ $size->size }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
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
<style>
    .product_box {
        position: relative;
    }

    .variant-hov {
        text-align: left;
        position: absolute;
        z-index: 8;
        background: rgba(242, 242, 242, 1);
        top: 0;
        left: 101%;
        min-width: 80px;
        height: auto;
        padding: 8px 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product_box:hover .variant-hov {
        opacity: 1;
    }

    .variant-hov::before {
        content: '';
        position: absolute;
        top: 5px;
        /* adjust vertically */
        left: -15px;
        /* pull it left into the parent */
        border-width: 8px;
        border-style: solid;
        border-color: transparent rgba(242, 242, 242, 1) transparent transparent;
    }

    .product__details__holder__quick-view__group__subtitle {
        margin: 0;
        color: #48555f;
        font-size: 13px;
        font-weight: 600;
    }

    .no-bullet {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .product__details__holder li {
        font-size: 11px;
        color: #48555f;
    }
</style>
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
