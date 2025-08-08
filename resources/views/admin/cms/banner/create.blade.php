<x-page-content title="Add Banner" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.banners.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.select label="Select Catagory" name="category_id" id="category_id" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getAllCategories()" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-4 mt-4" :value="old('position')" :value="1" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-4 mt-4"
                        :options="Midhas::getStatus()" :value="1" />

                    <x-forms.select label="Banner Type" name="type" id="type" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getType()" :value="1" />

                    <x-forms.input label="Upload Image" type="file" name="banner_image_path[]" id="banner_image_path"
                        :required="false" size="col-lg-4 mt-4" :value="old('banner_image_path')" class="image-file" :image="true"
                        multiple />

                    <div class="row mt-2" id="image-preview-container"></div>
                    <x-forms.select label="Select Catagory" name="category_id" id="category_id" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getAllCategories()" />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const type = document.getElementById('type');
                const imageInput = document.getElementById('banner_image_path');
                const container = document.getElementById('image-preview-container');

                imageInput.addEventListener('change', function(event) {
                    const selectedType = parseInt(type.value);
                    const selectedFiles = event.target.files;

                    container.innerHTML = '';
                    if (selectedFiles.length > selectedType) {
                        alert(`You can upload a maximum of ${selectedType} image(s) for this banner type.`);
                        imageInput.value = '';
                        return;
                    }


                    Array.from(selectedFiles).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '100px';
                            img.style.height = 'auto';
                            img.style.margin = '10px';
                            img.style.borderRadius = '8px';
                            img.style.border = '1px solid #ccc';
                            container.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
    @endpush
</x-page-content>
