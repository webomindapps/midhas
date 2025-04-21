@props([
    'existing' => null,
])
<x-accordion.item id="seo-details" title="SEO Details">
    <div class="row">
        <x-forms.input label="Meta Title" type="text" name="meta_title" id="meta_title" :required="false"
            size="col-lg-6 mt-4" :value="$existing ? $existing->meta_title : old('meta_title')" />
        <x-forms.input label="Meta Description" type="text" name="meta_description" id="meta_description"
            :required="false" size="col-lg-6 mt-4" :value="$existing ? $existing->meta_description : old('meta_description')" />

        <x-forms.textarea label="Meta Keywords" name="meta_keywords" id="meta_keywords" :required="false"
            size="col-lg-12 mt-4" :value="$existing ? $existing->meta_keywords : old('meta_keywords')" />
    </div>
</x-accordion.item>
