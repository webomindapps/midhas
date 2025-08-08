<x-frontend.page>
    <x-frontend.my-profile>
        <div class="row">
            <div class="col-md-3">
                <h3 class="mb-3">Edit Address</h3>
            </div>
        </div>

        <div class="row mt-4">
            <form action="{{ route('customer.edit.address', $address->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form_wrapper bg-light p-4 rounded shadow-sm">
                            <div class="d-block" aria-labelledby="form-title">

                                <div class="mb-3">
                                    <input type="text" name="firstname" class="form-control" placeholder="First Name"
                                        value="{{ old('firstname', $address->first_name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name"
                                        value="{{ old('lastname', $address->last_name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="address_1" class="form-control"
                                        placeholder="Address Line 1" value="{{ old('address_1', $address->address_1) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="address_2" class="form-control"
                                        placeholder="Address Line 2 (optional)"
                                        value="{{ old('address_2', $address->address_2) }}">
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="city" class="form-control" placeholder="City"
                                        value="{{ old('city', $address->city) }}" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="postal_code" class="form-control"
                                        placeholder="Postal Code" value="{{ old('postal_code', $address->postal_code) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="province" class="form-control"
                                        placeholder="Province/Region" value="{{ old('province', $address->province) }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="phone_number" class="form-control"
                                        placeholder="Phone Number"
                                        value="{{ old('phone_number', $address->phone_number) }}" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input type="submit"
                                        class="theme_btn text-uppercase text-center d-block text-white"
                                        value="Save Details">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </x-frontend.my-profile>
</x-frontend.page>
