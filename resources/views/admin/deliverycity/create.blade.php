<x-page-content title="Add Delivery City" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.settings.delivery-city.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.input label="City" type="text" name="city" id="city" :required="true"
                        size="col-lg-6 mt-2" :value="old('city')" />

                    <x-forms.input label="Delivery Price" type="number" name="delivery_price" id="delivery_price"
                        :required="true" size="col-lg-6 mt-2" :value="old('delivery_price')" />

                    <x-forms.input label="Minimum Amount For Shipping Charges" type="number"
                        name="min_amt_for_shipping" id="min_amt_for_shipping" :required="true" size="col-lg-6 mt-2"
                        :value="old('min_amt_for_shipping')" />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
