<x-frontend.page>
    <x-frontend.my-profile>
        <div class="row">
            <div class="col-md-3">
                <h3 class="mb-3">Change Password</h3>
            </div>

        </div>
        <div class="row mt-4">
            <form action="{{ route('customer.resetpassword') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form_wrapper bg-light p-4 rounded shadow-sm">


                            <div class="d-block" aria-labelledby="form-title">


                                <div class="password-container position-relative">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        id="input-password" aria-label="Password input field" aria-required="true"
                                        aria-describedby="input-password-description">
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
                                <div class="col-md-12 mb-3">

                                    <input type="submit"
                                        class="theme_btn text-uppercase  text-center d-block text-white"value="Save Details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
