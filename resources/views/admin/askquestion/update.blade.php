<x-page-content title="View Questions" :isBack="true">
    <div class="row">
        <x-forms.input label="Name" type="text" name="name" id="name" size="col-lg-6 mt-2" :value="old('name', $questions->name)"
            readonly />

        <x-forms.input label="Email" type="email" name="email" id="delivery_price" :required="true"
            size="col-lg-6 mt-2" :value="old('email', $questions->email)" readonly />

        <x-forms.input label="Phone" type="number" name="min_amt_for_shipping" id="min_amt_for_shipping"
            size="col-lg-6 mt-2" :value="old('Phone', $questions->phone)" readonly />

        <x-forms.textarea label="Question" id="min_amt_for_shipping" rows="5" size="col-lg-6 mt-2"
            :value="old('Phone', $questions->question)" :readonly="true">
        </x-forms.textarea>

    </div>
</x-page-content>
