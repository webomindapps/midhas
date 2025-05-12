@section('metaTitle', $pageDetails->meta_title)
@section('metaDescription', $pageDetails->meta_description)
@section('metaKeywords', $pageDetails->meta_keywords)
<x-frontend.page>

    <div class="content brdcrumb detail_page mt-3 p-3 mb-5 ">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageDetails->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="container normal secs">
            <div class="row pb-5">
                <h3>{{ $pageDetails->title }}</h3>
                <div class="mt-3">
                    {!! $pageDetails->description !!}
                </div>
            </div>
        </div>
    </div>
</x-frontend.page>
