@props(['id'])

<div class="input-group justify-content-md-center justify-content-start">
    <input type="button" value="-" data-id="{{ $id }}" class="button-minus qtyDecrement">

    <input type="text" step="1" value="1" name="quantity" id="quantity-{{ $id }}"
        class="quantity-field quantity-{{ $id }}">

    <input type="button" value="+" data-id="{{ $id }}" class="button-plus qtyIncrement">
</div>
