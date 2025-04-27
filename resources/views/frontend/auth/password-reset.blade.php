<x-app-layout>
    @section('main-content')
        <section class="section login_form">
            <div class="container">
                <div class="col-lg-8 col-md-12 mx-auto">
                    <div class="col-md-12">
                        <div class="row whole_wrapper">
                            <div
                                class="col-md-5 bg-orange p-0 d-md-flex d-none justify-content-center align-items-center login_left">
                                <img src="{{ asset('frontend/images/offer-2.jpg') }}" alt="" class="img-fluid mx-auto">
                            </div>
                            <div class="col-md-7 p-md-5 p-3">
                                <h2 class="text-center fw-bold">Reset Password </h2>
                                <p class="text-center">Enter Email to Reset Password</p>
                                <div class="form_wrapper pt-3">
                                    <div class="form_wrapper pt-3">
                                        <form class="d-block mb-4" aria-labelledby="form-title"
                                            action="{{ route('password.store') }}" method="POST">
                                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                            @csrf
                                            <p class="text-center">If you want to change your old password, reset it by
                                                entering
                                                your new
                                                password.</p>
                                            <div class="form-floating mb-3">
                                                <input type="email" name="email" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com"
                                                    value="{{ old('email', request()->query('email')) }}">
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                            @error('email')
                                                <span style="font-size:12px;color:red;">{{ $message }}</span>
                                            @enderror
                                            <div class="form-floating mb-3">
                                                <input type="password" name="password" class="form-control input-password"
                                                    id="floatingPassword" placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                                <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                                            </div>
                                            @error('password')
                                                <span style="font-size:12px;color:red;">{{ $message }}</span>
                                            @enderror
                                            <div class="form-floating mb-3">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control input-password" id="floatingPassword"
                                                    placeholder="Password">
                                                <label for="floatingPassword">Confirm Password</label>
                                                <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                                            </div>
                                            @error('password_confirmation')
                                                <span style="font-size:12px;color:red;">{{ $message }}</span>
                                            @enderror
                                            <div class="col-auto text-center">
                                                <button type="submit"
                                                    class="btn btn-outline-secondary login-btn w-100 mb-3">Reset
                                                    Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
