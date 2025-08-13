@props(['existing' => []])
@php
    $existingValues = collect($existing)->pluck('value', 'specification_id')->toArray();
@endphp
<div class="row">
    @foreach ($specifications as $specification)
        <x-forms.input label="{!! $specification->name !!}" type="text" name="specifications[{{ $specification->id }}]"
            id="specifications[{{ $specification->id }}]" :required="false" size="col-lg-3" :value="old('specifications[' . $specification->id . ']', $existingValues[$specification->id] ?? '')" />
    @endforeach
</div>
