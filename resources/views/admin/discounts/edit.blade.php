<x-page-content title="Edit Discount Coupon" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.discounts.update', $discount->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-forms.input label="Coupon Code" type="text" name="code" id="code" :required="true"
                        size="col-lg-6 mt-4" :value="$discount->code" class="slug" />

                    <x-forms.select label="Discount Type" name="type" id="type" :required="true"
                        size="col-lg-6 mt-4" :options="Midhas::discountType()" :value="$discount->type" />

                    <x-forms.input label="Discount Value" type="number" name="value" id="value" :required="true"
                        size="col-lg-6 mt-4" :value="$discount->value" />

                    <x-forms.select label="Coupon Type" name="coupon_type" id="coupon_type" :required="true"
                        size="col-lg-6 mt-4" :options="Midhas::discountCouponType()" :value="$discount->coupon_type" />

                    <x-forms.input label="Discount Limit" type="number" name="limit" id="limit"
                        :required="false" size="col-lg-6 mt-4" :value="$discount->limit" />

                    <x-forms.input label="Expiry Date" type="date" name="expiry_date" id="expiry_date"
                        :required="false" size="col-lg-6 mt-4" :value="$discount->getRawOriginal('expiry_date')" />

                    <x-forms.select label="Applicable For" name="applicable_for" id="applicable_for" :required="true"
                        size="col-lg-6 mt-4" :options="Midhas::discountApplicable()" :value="$discount->applicable_for" />

                    <x-forms.input label="SKU" type="text" name="sku" id="sku" :required="false"
                        size="col-lg-6 mt-4" :value="$discount->sku" class="slug" placeholder="sku-1,sku-2" />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            $(document).ready(function() {
                var applicable_for = $('#applicable_for').val();
                if (applicable_for == 2) {
                    $('#form-group-sku').css('display', 'block')
                } else {
                    $('#form-group-sku').css('display', 'none')
                }
            })
            $('#applicable_for').on('change', function() {
                console.log($(this).val());
                var value = $(this).val();
                if (value == 2) {
                    $('#form-group-sku').css('display', 'block')
                } else {
                    $('#form-group-sku').css('display', 'none')
                }
            })
        </script>
    </x-slot:scripts>
</x-page-content>
