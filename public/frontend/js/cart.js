$(document).on("click", ".qtyIncrement", function () {
    var id = $(this).data("id");
    var currentValue = parseInt($(`#quantity-${id}`).val()) || 1;

    $(`.quantity-${id}`).val(currentValue + 1).trigger('change');
});

$(document).on("click", ".qtyDecrement", function () {
    var id = $(this).data("id");
    var currentValue = parseInt($(`#quantity-${id}`).val()) || 1;

    if (currentValue > 1) {
        $(`.quantity-${id}`).val(currentValue - 1).trigger('change');
    }
});

$(document).on("click", ".addToCart", function () {
    let product_id = $(this).data("id");
    let variant = $(this).data("variant");
    let qty = $(`#quantity-${product_id}`).val();
    let comments = $('#comments').val();
    console.log(variant);
    addToCart(product_id, qty, comments, variant);
});
const addToCart = (id, qty, comments, variant) => {

    let url = window.location.origin + "/add/cart";

    $.ajax({
        type: "POST",
        url: url,
        data: {
            product_id: id,
            variant_id: variant,
            qty: qty,
            comments: comments,
            _token: document.querySelector('meta[name="csrf-token"]').content,

        },

        success: function (response) {
            if (response.success) {
                hoverCartItems();
                $("#quantity").val(1);
                window.FlashMessage.info('Item was successfully added to the cart', {
                    timeout: 2000,
                    progress: true
                });
            } else if (response.error) {
                window.FlashMessage.error('Stock not Available', {
                    timeout: 2000,
                    progress: true
                });
            } else {
                console.error("Unexpected response:", response);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
};