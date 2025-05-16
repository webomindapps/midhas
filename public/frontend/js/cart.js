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

$(document).ready(function () {
    hoverCartItems();

    // Show cart on hover
    $("#miniCart").hover(
        function () {
            hoverCartItems(); // Load items on hover
            showMiniCart();   // Show the cart
        },
        function () {
            hideMiniCart();   // Hide when not hovering
        }
    );
});

function hoverCartItems(update = false) {
    let url = window.location.origin + "/minicart-items";

    if (!update) {
        hideMiniCart();
    }

    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            if (response.count > 0) {
                if (!update) {
                    showMiniCart();
                }
                $("#hovedCart").html(response.html);
                $("#item-count").text(response.count);
                $("#item-count-sm").text(response.count);
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
}

const showMiniCart = () => {
    $("#miniCart").addClass("v_cart");
};

const hideMiniCart = () => {
    $("#miniCart").removeClass("v_cart");
};

$(document).on("click", ".addToCart", function () {
    let product_id = $(this).data("id");
    let qty = parseInt($(`#quantity-${product_id}`).val()) || 1;

    if (qty <= 0) {
        alert("Please enter a valid quantity");
        return;
    }
    console.log("Adding to cart:", product_id, qty);
    addToCart(product_id, qty);
});


const addToCart = (id, qty) => {
    let url = window.location.origin + "/add/cart";
    console.log(url);
    $.ajax({
        type: "POST",
        url: url,
        data: {
            product_id: id,
            qty: qty,
            _token: document.querySelector('meta[name="csrf-token"]').content,
        },
        success: function (response) {
            if (response.success) {
                $(`#quantity-${id}`).val(1);
                window.FlashMessage?.info?.('Item was successfully added to the cart', {
                    timeout: 2000,
                    progress: true
                });
            } else if (response.error) {
                window.FlashMessage?.error?.('Stock not Available', {
                    timeout: 2000,
                    progress: true
                });
            } else {
                console.error("Unexpected response:", response);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
    console.log(url);
};

const updateCart = (id, qty) => {
    let url = window.location.origin + "/cart/update";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            item_id: id,
            qty: qty,
            _token: document.querySelector('meta[name="csrf-token"]').content,
        },
        success: function (response) {
            hoverCartItems(true);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(".enquire-btn").prop("disabled", false);
        },
    });
};