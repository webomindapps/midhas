<footer id="m_footer">
    <div class="section top_footer text_hind w-100 text-white">
        <div class="container text-center ">
            <div class="d-md-flex align-items-center justify-content-center">
                <h2 class="text-uppercase text_hind text-white mb-0 me-sm-4 mb-sm-0 mb-2"> Follow Us</h2>
                <ul class="list_styled text-white d-flex gx-4 align-items-center">
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section main_footer text_hind w-100 bg-black text-white">
        <div class="container">
            <div class="col-12">
                <div class="row sm-flex-column-reverse">
                    <div class="col-lg-8 px-lg-0">
                        <div class="row justify-content-between">
                            <div class="col-lg-4">
                                <h2 class="text-uppercase">MIDHA’S FURNITURE GALLERY</h2>
                                <ul class="list_styled">
                                    @foreach (Midhas::pages() as $page)
                                        <li><a href="{{ route('page.view', $page->slug) }}">{{ $page->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-3">
                                <h2 class="text-uppercase">SHOPPING</h2>
                                <ul class="list_styled">
                                    <li><a href="">Your Account</a></li>
                                    <li><a href="">Competitions</a></li>
                                    <li><a href="">Presale</a></li>
                                    <li><a href="">Loyalty Scheme</a></li>
                                    <li><a href="">Birthday Discount</a></li>
                                    <li><a href="">Discounts Hub</a></li>
                                    <li><a href="">FAQ's</a></li>
                                    <li><a href="">Blog</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <h2 class="text-uppercase">Popular Categories</h2>
                                <ul class="list_styled">
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 px-lg-0">
                        <div class="row">
                            <h2 class="text-uppercase">NEWSLETTER SIGNUP</h2>
                            <form class="d-flex" action="{{ route('newsletter.store') }}" aria-labelledby="form-title">
                                <!-- Form Title (for accessibility) -->
                                <h2 id="form-title" class="visually-hidden">Form for Newsletter SignUp</h2>

                                <!-- Input field with aria-label for better accessibility -->
                                <input type="email" name="email"
                                    class="form-control text-white bg-transparent border-end-0" placeholder="Enter text"
                                    id="input-text" aria-label="Text input field" aria-required="true"
                                    aria-describedby="input-text-description">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <!-- Description for input field (for accessibility) -->
                                <p id="input-text-description" class="visually-hidden">Please enter your email ID</p>

                                <!-- Submit button with aria-label for better accessibility -->
                                <button class="btn text-white" type="submit" aria-label="Submit the form"><svg
                                        fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 20">
                                        <path stroke="#fff" stroke-width="2" d="M24 10H0m15-9 9 9-9 9" />
                                    </svg></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section main_bottom py-3 text_hind w-100 bg-white text-black">
        <div class="container">
            <div class="col-12">
                <div class="row align-items-center">
                    <p class="mb-0 col-md-4">© 2025 — Copyright All Right Reserved.</p>
                    <img src="{{ asset('frontend/images/payments.jpg') }}" alt=""
                        class="img-fluid col-md-4 my-sm-0 my-2">
                    <p class="mb-0 col-md-4 text-end">Privacy Policy</p>
                </div>
            </div>
        </div>
    </div>
</footer>
