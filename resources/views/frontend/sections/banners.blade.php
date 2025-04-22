<section class="herobanner overflow-hidden d-flex align-items-center justify-content-center mb-4">

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
        data-bs-pause="false">
        <div class="carousel-inner">
            @if ($sliders->isNotEmpty())
                @foreach ($sliders as $index => $slider)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }} position-relative w-100">
                        <a href="{{ $slider->url }}"> <img src="{{ asset('storage/' . $slider->slider_image) }}"
                                class="d-block w-100" alt="Slide 1"></a>
                    </div>
                @endforeach
            @else
                <div class="carousel-item active position-relative w-100">
                    <img src="{{ asset('frontend/images/m_banner.jpg') }}" class="d-block w-100"
                        alt="No sliders available">
                </div>
            @endif
        </div>
        @if ($sliders->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
</section>
