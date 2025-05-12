@props([
    'existing' => null,
])
<div class="row g-3">
    <x-forms.input label="Color" type="text" name="color" id="specifications1" :required="false" size="col-lg-2"
        :value="old('color', $existing?->color)" />
    <x-forms.input label="Size" type="text" name="size" id="specifications2" :required="false" size="col-lg-2"
        :value="old('size', $existing?->size)" />
    <x-forms.input label="Material" type="text" name="material" id="specifications3" :required="false"
        size="col-lg-2" :value="old('material', $existing?->material)" />
    <x-forms.input label="Style" type="text" name="style" id="specifications4" :required="false" size="col-lg-2"
        :value="old('style', $existing?->style)" />
    <x-forms.input label="Number Of Drawers" type="text" name="no_of_drawers" id="specifications5" :required="false"
        size="col-lg-2" :value="old('no_of_drawers', $existing?->no_of_drawers)" />
    <x-forms.input label="Number of Doors" type="text" name="no_of_doors" id="specifications6" :required="false"
        size="col-lg-2" :value="old('no_of_doors', $existing?->no_of_doors)" />
    <x-forms.input label="Number of Hooks" type="text" name="no_of_hooks" id="specifications7" :required="false"
        size="col-lg-2" :value="old('no_of_hooks', $existing?->no_of_hooks)" />
    <x-forms.input label="Number of Shelves" type="text" name="no_of_shelves" id="specifications8" :required="false"
        size="col-lg-2" :value="old('no_of_shelves', $existing?->no_of_shelves)" />
    <x-forms.input label="Assembly" type="text" name="assembly" id="specifications1" :required="false"
        size="col-lg-2" :value="old('assembly', $existing?->assembly)" />
    <x-forms.input label="Upholstery Material" type="text" name="upholstery_material" id="specifications9"
        :required="false" size="col-lg-2" :value="old('upholstery_material', $existing?->upholstery_material)" />
</div>
