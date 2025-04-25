<x-page-content title="Add Page" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.pages.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.input label="Title" type="text" name="title" id="title" :required="true"
                        size="col-lg-6 mt-4" :value="old('title')" class="slug" />

                    <x-forms.input label="Slug" type="text" name="slug" id="slug" :required="true"
                        size="col-lg-6 mt-4" :value="old('slug')" />

                    <x-forms.textarea label="Description" name="description" id="description" :required="true"
                        size="col-lg-12 mt-4" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-6 mt-4" :value="old('position')" :value="1" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-6 mt-4 mb-2"
                        :options="Midhas::getStatus()" :value="1" />

                    <x-admin.seo-form />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

</x-page-content>
