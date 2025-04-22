<x-page-content title="Add Slider" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.sliders.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.select label="Select Catagory" name="category_id" id="category_id" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getAllCategories()" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-4 mt-4" :value="old('position')" :value="1" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-4 mt-4"
                        :options="Midhas::getStatus()" :value="1" />

                    <x-forms.input label="URL" type="text" name="url" id="url" :required="false"
                        size="col-lg-4 mt-4" :value="old('url')" />

                    <x-forms.input label="Upload Slider" type="file" name="slider_image" id="slider_image"
                        :required="false" size="col-lg-4 mt-4" :value="old('slider_image')" class="image-file"
                        :image="true" />

                  

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

</x-page-content>
