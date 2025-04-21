<x-page-content title="Add Brand" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.masters.brands.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                        size="col-lg-4 mt-4" :value="old('name')" class="slug" />

                    <x-forms.input label="Slug" type="text" name="slug" id="slug" :required="true"
                        size="col-lg-4 mt-4" :value="old('slug')" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-4 mt-4" :value="old('position')" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-4 mt-4"
                        :options="Midhas::getStatus()" :value="1" />

                    <x-forms.input label="Upload Image" type="file" name="thumbnail" id="thumbnail" :required="false"
                        size="col-lg-4 mt-4" :value="old('thumbnail')" class="image-file" :image="true" />
                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
