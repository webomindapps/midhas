@props(['id', 'value' => 1])

<div class="input-group justify-content-md-center justify-content-start">
    <input type="button" value="-" data-id="{{ $id }}" class="button-minus qtyDecrement">

    <input type="text" step="1" value="{{ $value }}" name="quantity" id="quantity-{{ $id }}"
        class="quantity-field quantity-{{ $id }}"  readonly>

    <input type="button" value="+" data-id="{{ $id }}" class="button-plus qtyIncrement">
</div>
