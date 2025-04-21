@props(['title', 'isCreate', 'createLink', 'isBack', 'isBackLink'])
<div class="page-header">
    <div class="row">
        <div class="col-lg-4 d-flex align-items-center">
            @if (isset($isBack) && $isBack)
                <a href="{{ $isBackLink }}"><i class="fas fa-chevron-left fs-5"></i></a>
            @endif

            <h3>{{ $title }}</h3>
        </div>
        <div class="col-lg-8 d-flex align-items-center justify-content-end">
            @if (isset($isCreate) && $isCreate)
                <a href="{{ $createLink }}" class="add-btn bg-success text-white">Add</a>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
