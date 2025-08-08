<x-page-content title="View list" :isBack="true">
    <div class="row">
        <x-forms.input label="Name" type="text" name="name" id="name" size="col-lg-6 mt-2" :value="old('name', $tellafriend->name)"
            readonly />

        <x-forms.input label="Email" type="email" name="email" id="delivery_price" :required="true"
            size="col-lg-6 mt-2" :value="old('email', $tellafriend->email)" readonly />

        <x-forms.input label="Friends Name" type="text" name="friends_name" id="friends_name" :required="true"
            size="col-lg-6 mt-2" :value="old('friends_name', $tellafriend->friends_name)" readonly />

        <x-forms.input label="Friend's Email" type="text" name="friends_email" id="friends_email"
            size="col-lg-6 mt-2" :value="old('friends_email', $tellafriend->friends_email)" readonly />


        <x-forms.textarea label="Question" id="min_amt_for_shipping" rows="5" size="col-lg-6 mt-2"
            :value="old('Phone', $tellafriend->message)" :readonly="true">
        </x-forms.textarea>

    </div>
</x-page-content>
