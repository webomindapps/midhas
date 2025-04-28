@props(['product'])

<div class="product_box">
    <a href="{{ route('productByCategory', $product->slug) }}">
        <div class="prd_img">
            <img src="{{ $product->thumbnail }}" alt="{{ $product->title }}" class="w-100 img-fluid">
    </a>
</div>
<div class="color_selector d-flex justify-content-center">
    <span class="active" style="--color:#B3B3B3"></span>
    <span style="--color:#252831"></span>
</div>
<h3 class="prd_name text_hind fw-bold">{{ $product->title }}</h3>
<span class="prd_price fw-bold d-block">{{ $product->msrp }}</span>
<div class="d-flex text_inter prd_actions">
    <div class="col">
        <a href="#" class="buy d-block">Buy</a>
    </div>
    <div class="col">
        <a href="#" class="view d-block">View</a>
    </div>
</div>
</div>
