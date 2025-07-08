<x-page-content title="Add Blog" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.blogs.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.input label="Blog Title" type="text" name="blog_title" id="blog_title" :required="true"
                        size="col-lg-6 mt-4" :value="old('blog_title')" />

                    <x-forms.input label="Blog Date" type="date" name="blog_date" id="blog_date" :required="true"
                        size="col-lg-6 mt-4" :value="old('blog_date')" />

                    <x-forms.textarea label="Description" name="blog_description" id="blog_description"
                        :required="true" size="col-lg-12 mt-4" />
                    <x-forms.input label="Blog Image" type="file" name="blog_image" id="blog_image" :required="false"
                        size="col-lg-6 mt-4 mb-4" :value="old('blog_image')" :multiple="false" class="image-file multiple-images"
                        :image="true" />

                    <x-admin.seo-form />



                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
