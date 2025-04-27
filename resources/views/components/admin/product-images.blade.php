@props(['items' => []])

<div class="col-lg-12">
    <p>Uploaded Images</p>
    <div class="row text-center">
        @foreach ($items as $item)
            <div class="col-lg-2 mb-2 position-relative product-detail-img-section" id="prd-section-{{ $item->id }}">
                <a data-url="{{ url('/admin/deleteProductImage') }}" data-id="{{ $item->id }}"
                    class="prd-Image-delete"><i class="fa fa-times image-trash" aria-hidden="true"></i></a>
                <img style="height: 80px" src="{{ $item->url }}" alt="">
            </div>
        @endforeach
    </div>
</div>
