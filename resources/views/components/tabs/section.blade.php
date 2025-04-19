@props([
    'id' => 'pills',
    'heading',
])

<ul class="nav nav-pills mb-3" id="{{ $id }}-tab" role="tablist">
    {{ $heading }}
</ul>

<div class="tab-content product-description-tab" id="{{ $id }}-tabContent">
    {{ $slot }}
</div>
