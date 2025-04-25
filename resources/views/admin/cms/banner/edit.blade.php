<x-page-content title="Edit Banner" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.banners.update', $banner) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <x-forms.select label="Select Catagory" name="category_id" id="category_id" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getAllCategories()" :value="$banner->category_id" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-4 mt-4" :value="old('position')" :value="$banner->position" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-4 mt-4"
                        :options="Midhas::getStatus()" :value="$banner->status" />

                    <x-forms.select label="Banner Type" name="type" id="type" :required="true"
                        size="col-lg-4 mt-4" :options="Midhas::getType()" :value="$banner->type" />

                    <x-forms.input label="Upload Image" type="file" name="banner_image_path[]" id="banner_image_path"
                        :required="false" size="col-lg-4 mt-4" imageValue="{{ $banner->banner_image_path }}"
                        class="image-file" :image="true" multiple />
                        @if ($banner->images->isNotEmpty())
                        <div class="mt-3">
                            <div class="row">
                                @foreach ($banner->images as $image)
                                    <div class="col-lg-1">
                                        <img src="{{ asset('storage/' . ltrim($image->banner_url, '/')) }}" alt="Banner Image"
                                             class="img-thumbnail shadow-sm" style="width: 100px; border-radius: 8px;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
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

                function validateImageCount() {
                    const selectedType = parseInt(type.value);
                    const selectedFiles = imageInput.files.length;

                    if (selectedFiles > selectedType) {
                        alert(`You can upload a maximum of ${selectedType} image(s) for this banner type.`);
                        imageInput.value = '';
                    }
                }

                imageInput.addEventListener('change', validateImageCount);
            });
        </script>
    @endpush
</x-page-content>
