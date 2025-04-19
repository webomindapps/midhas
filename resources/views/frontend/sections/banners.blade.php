<section class="herobanner overflow-hidden d-flex align-items-center justify-content-center mb-4">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            <div class="carousel-item active position-relative w-100">
                <img src="{{asset('frontend/images/m_banner.jpg')}}" class="d-block w-100" alt="Slide 1">
                <div class="container text-center position-absolute top-50 start-50 translate-middle">
                    <h1 class="text_inter text-white position-relative">Transform Your Home with Style</h1>
                </div>
            </div>
            <div class="carousel-item position-relative w-100">
                <img src="{{asset('frontend/images/m_banner2.jpg')}}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item position-relative w-100">
                <img src="{{asset('frontend/images/m_banner.jpg')}}" class="d-block w-100" alt="Slide 3">
                <div class="container text-center position-absolute top-50 start-50 translate-middle">
                    <h1 class="text_inter text-white position-relative">Transform Your Home with Style</h1>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</section>
