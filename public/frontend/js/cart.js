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

    // $("#miniCart").hover(
    //     function () {
    //         hoverCartItems();
    //         showMiniCart();
    //     },
    //     function () {
    //         hideMiniCart();
    //     }
    // );
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
    $("#miniCart").addClass("show");
};

const hideMiniCart = () => {
    $("#miniCart").removeClass("show");
};

$(document).on("click", ".addToCart", function () {
    let product_id = $(this).data("id");
    let qty = parseInt($(`#quantity-${product_id}`).val()) || 1;
    let variant = $(this).data("variant");
    console.log(variant);

    if (qty <= 0) {
        alert("Please enter a valid quantity");
        return;
    }
    console.log("Adding to cart:", product_id, qty);
    addToCart(product_id, qty, variant);
});


const addToCart = (id, qty, variant) => {
    const url = window.location.origin + "/add/cart";

    let accessoryIds = [];
    let accessoryPrices = [];

    document.querySelectorAll('.accessory-option.selected').forEach(option => {
        let accId = option.getAttribute('data-id');
        let accPrice = option.getAttribute('data-price');

        if (accId && accPrice) {
            accessoryIds.push(parseInt(accId));
            accessoryPrices.push(parseFloat(accPrice));
        }
    });

    console.log("Accessory IDs:", accessoryIds);
    console.log("Accessory Prices:", accessoryPrices);

    $.ajax({
        type: "POST",
        url: url,
        data: {
            product_id: id,
            variant_id: variant,
            accessory_ids: accessoryIds,
            accessory_price: accessoryPrices,
            qty: qty,
            _token: document.querySelector('meta[name="csrf-token"]').content,
        },
        success: function (response) {
            if (response.success) {
                hoverCartItems();
                $(`#quantity-${id}`);
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