<x-page-content title="Edit Slider" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.sliders.update', $slider) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <x-forms.select label="Select Catagory" name="category_id" id="category_id" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getAllCategories()" :value="$slider->category_id" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-4 mt-4" :value="old('position')" :value="$slider->position" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-4 mt-4"
                        :options="Midhas::getStatus()" :value="$slider->status" />

                    <x-forms.input label="URL" type="text" name="url" id="url" :required="false"
                        size="col-lg-4 mt-4" :value="$slider->url" />

                    <x-forms.input label="Upload Slider" type="file" name="slider_image" id="slider_image"
                        :required="false" size="col-lg-4 mt-4"
                        imageValue="{{ asset('storage/' . $slider->slider_image) }}" class="image-file"
                        :image="true" />


                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

</x-page-content>
