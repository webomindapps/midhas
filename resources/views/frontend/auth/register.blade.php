<x-app-layout>
    @section('title', 'Login')
    @section('main-content')
        <section class="section breadcrumb pb-0 seo_content w-100">
            <div class="container text-start">
                <ul class="list_styled d-flex breadcrumb mb-5">
                    <li><a href="">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                    <li>Create account</li>
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
                                <img src="{{ asset('frontend/images/offer-2.jpg  ') }}" alt=""
                                    class="img-fluid mx-auto">
                            </div>
                            <div class="col-md-7 p-md-5 p-3">
                                <h2 class="text-center fw-bold">Create Account</h2>
                                <p class="text-center">Fill in your details to get started</p>
                                <div class="form_wrapper pt-3">
                                    <form class="d-block mb-4" aria-labelledby="form-title"
                                        action="{{ route('customer.sign-up') }}" method="POST">
                                        @csrf
                                        <!-- Form Title (for accessibility) -->
                                        <h2 id="form-title" class="visually-hidden">Form for Account User Login</h2>

                                        <!-- Input field with aria-label for better accessibility -->
                                        <input type="text" class="form-control" placeholder="Enter your name"
                                            id="input-text" name="name" aria-label="Text input field"
                                            aria-required="true" aria-describedby="input-text-description"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <!-- Input field with aria-label for better accessibility -->
                                        <input type="email" class="form-control" placeholder="Enter mail ID"
                                            id="input-email" name="email" aria-label="Email input field"
                                            aria-required="true" aria-describedby="input-email-description"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="password-container position-relative">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" id="input-password" aria-label="Password input field"
                                                aria-required="true" aria-describedby="input-password-description">
                                            <i class="fa-solid fa-eye eye-icon toggle-password"
                                                data-target="input-password"></i>
                                        </div>

                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="password-container position-relative mt-2">
                                            <input type="password" class="form-control" placeholder="Confirm Password"
                                                id="input-c-password" name="conf_password"
                                                aria-label="Confirm Password input field" aria-required="true"
                                                aria-describedby="input-confirm-password-description">
                                            <i class="fa-solid fa-eye eye-icon toggle-password"
                                                data-target="input-c-password"></i>
                                        </div>


                                        <!-- Submit button with aria-label for better accessibility -->
                                        <button class="btn text-white d-block w-100 bg-orange" type="submit"
                                            aria-label="Submit the form">Sign up</button>
                                    </form>

                                    <p class="text-center mb-0"> Already have an account? <a
                                            href="{{ route('customer.login') }}" class="text_orange"> Login here</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
