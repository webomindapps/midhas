<x-page-content title="Add Category" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.categories.store') }}"
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
                    <div class="col-lg-4 mt-4">
                        <label class="form-check-label d-block mb-2">Show Category In Nav Bar <span
                                class="text-danger">*</span></label>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="show_in_nav" id="show_in_nav_yes" value="1"
                                class="form-check-input" {{ old('show_in_nav') == 1 ? 'checked' : '' }} required="true">
                            <label class="form-check-label" for="show_in_nav_yes">Yes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="show_in_nav" id="show_in_nav_no" value="0"
                                class="form-check-input" {{ old('show_in_nav') == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_in_nav_no">No</label>
                        </div>
                    </div>


                    <div class="mt-4">
                        <x-accordion.item id="category" title="Select Category">
                            <div class="row">
                                <x-admin.category.category />
                            </div>
                        </x-accordion.item>
                    </div>

                    <x-admin.seo-form />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
