@props(['item', 'options'])
<div class="dropdown pop_Up dropdown_bg">
    <div class="dropdown-toggle" id="dropdownMenuButton-{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="true">
        Action
    </div>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-95px, -25.4219px);"
        data-popper-placement="top-end">
        @foreach ($options as $option)
            {!! Midhas::getAction($option['code'], $option['route'], $item, $option['additional'] ?? []) !!}
        @endforeach
    </ul>
</div>
