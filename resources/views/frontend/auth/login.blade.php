<x-app-layout>
    @section('title', 'Login')
    @section('main-content')
        <section class="section breadcrumb pb-0 seo_content w-100">
            <div class="container text-start">
                <ul class="list_styled d-flex breadcrumb mb-5">
                    <li><a href="">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                    <li>Login</li>
                </ul>

            </div>
        </section>

        <section class="section login_form">
            <div class="container">
                <div class="col-lg-8 col-md-12 mx-auto">
                    <div class="col-md-12">
                        <div class="row whole_wrapper">
                            <div
                                class="col-md-5 bg-orange p-0 d-md-flex d-none justify-content-center align-items-center login_left">
                                <img src="{{ asset('frontend/images/offer-1.jpg') }}" alt=""
                                    class="img-fluid mx-auto">
                            </div>
                            <div class="col-md-7 p-md-5 p-3">
                                <h2 class="text-center fw-bold">Welcome Back</h2>
                                <p class="text-center">Please login to your account</p>
                                <div class="form_wrapper pt-3">
                                    <form class="d-block mb-4" aria-labelledby="form-title"
                                        action="{{ route('customer.login') }}" method="POST">
                                        @csrf
                                        @if (session('danger'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('danger') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('verify'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('verify') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <!-- Form Title (for accessibility) -->
                                        <h2 id="form-title" class="visually-hidden">Form for Account User Login</h2>

                                        <!-- Input field with aria-label for better accessibility -->
                                        <input type="email" class="form-control" placeholder="Enter mail ID"
                                            id="input-email" name="email" aria-label="Email input field"
                                            aria-required="true" aria-describedby="input-email-description"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="password-container position-relative">
                                            <!-- Input field with aria-label for better accessibility -->
                                            <input type="password" class="form-control password-field"
                                                placeholder="Password" id="input-password" name="password"
                                                aria-label="Password input field" aria-required="true"
                                                aria-describedby="input-password-description">
                                            <i class="fa-solid fa-eye eye-icon toggle-password"
                                                data-target="input-password"></i> @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-end mb-3 pb-1">
                                            <a href="{{ route('password.request') }}" class="text_orange">Forgot
                                                password?</a>
                                        </div>

                                        <!-- Submit button with aria-label for better accessibility -->
                                        <button class="btn text-white d-block w-100 bg-orange" type="submit"
                                            aria-label="Submit the form">Login</button>
                                    </form>

                                    <p class="text-center mb-0"> Don't have an account? <a
                                            href="{{ route('customer.sign-up') }}" class="text_orange"> Create account</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
