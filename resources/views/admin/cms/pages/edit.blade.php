<x-page-content title="Edit Page" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.cms.pages.update', $page) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <x-forms.input label="Title" type="text" name="title" id="title" :required="true"
                        size="col-lg-6 mt-4" :value="$page->title" class="slug" />

                    <x-forms.input label="Slug" type="text" name="slug" id="slug" :required="true"
                        size="col-lg-6 mt-4" :value="$page->slug" />

                    <x-forms.textarea label="Description" name="description" id="description" :required="true"
                        :value="$page->description" size="col-lg-12 mt-4 " />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="false"
                        size="col-lg-6 mt-4" :value="$page->position" />

                    <x-forms.select label="Status" name="status" id="status" :required="true" size="col-lg-6 mt-4 mb-2"
                        :options="Midhas::getStatus()" :value="$page->status" />


                    <x-admin.seo-form :existing="$page->seo" />

                </div>
                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>
</x-page-content>
