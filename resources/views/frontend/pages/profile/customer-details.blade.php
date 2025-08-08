<x-frontend.page>
    <x-frontend.my-profile>
        <div class="row">
            <div class="col-md-3">
                <h3 class="mb-3">My Details</h3>
            </div>

        </div>
        <div class="row mt-4">
            <form action="{{ route('customer.details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form_wrapper bg-light p-4 rounded shadow-sm">


                            <div class="d-block" aria-labelledby="form-title">


                                <div class="col-md-12 mb-3">
                                    <label class="mb-1">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $customer->name }}" id="delivery_city">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="mb-1">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $customer->email }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">

                                    <input type="submit" class="theme_btn text-uppercase  text-center d-block text-white"value="Save Details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
