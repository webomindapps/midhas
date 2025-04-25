<x-page-content title="Add Specification" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.masters.specifications.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                        size="col-lg-3 mt-4" :value="old('name')" class="slug" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-3 mt-4" :value="old('position')" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-3 mt-4"
                        :options="Midhas::getStatus()" :value="1" />
                    <x-forms.select label="Is Filterable" name="is_filtrable" id="is_filtrable" :required="true"
                        size="col-lg-3 mt-4" :options="[
                            ['label' => 'Yes', 'value' => 1],
                            ['label' => 'No', 'value' => 0],
                        ]" :value="1" />
                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
