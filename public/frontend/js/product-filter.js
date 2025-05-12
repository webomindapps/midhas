var table = {
    is_new: "",
    is_best_seller: "",
    brand: "",
    price: "",
    sortBy: "",
    sortOrder: "",
    paginate: null,
    specifications: [],
};

$(document).ready(function () {
    let params = new URLSearchParams(window.location.search);
    let is_new = params.get("is_new");
    let is_best_seller = params.get("is_best_seller");
    let brands = params.get("brand");
    let price = params.get("price");
    let sale = params.get("sale");
    let paginate = params.get("paginate");
    let sort = params.get("sort");
    let order = params.get("order");
    let specParam = params.get("specifications");

    // Set brand checkboxes
    if (brands) {
        $(".brand").each(function () {
            var arr = brands.split(",");
            if (arr.indexOf($(this).val()) !== -1) {
                $(this).prop("checked", true);
            }
        });
    }

    // Set price radio
    if (price) {
        $(".price").each(function () {
            if ($(this).val() == price) {
                $(this).prop("checked", true);
            }
        });
    }

    // Sale checkbox
    if (sale) {
        if ($("#sale").val() == sale) {
            $("#sale").prop("checked", true);
        }
    }

    // Pagination
    table.paginate = paginate ? paginate : null;
    if (paginate) {
        $(".per_page").each(function () {
            if ($(this).val() === paginate) {
                $(this).prop("checked", true);
            }
        });
        var checkedLabel = $('input[name="limit"]:checked').next("span").text();
        $("#limit_label").text(checkedLabel);
    } else {
        $(".per_page[value='100']").prop("checked", true);
    }

    // Sorting
    if (sort && order && sort !== "" && order !== "") {
        $(".sorting").each(function () {
            if ($(this).data("column") === sort && $(this).data("sort") === order) {
                $(this).prop("checked", true);
            }
        });
        updateSortLabel();
    }

    // Specifications pre-check and logging
    if (specParam) {
        try {
            let specs = JSON.parse(decodeURIComponent(specParam));
            table.specifications = specs;
            specs.forEach(spec => {
                console.log(`Filter ID: ${spec.id}, Values: ${spec.values.join(", ")}`);
                spec.values.forEach(function (val) {
                    $(`.specifications[value="${val}"]`).each(function () {
                        let id = $(this).attr("id");
                        if (id && id.includes(`checkbox-${spec.id}-`)) {
                            $(this).prop("checked", true);
                        }
                    });
                });
            });
        } catch (e) {
            console.error("Invalid specifications format", e);
        }
    }
});

// Brand checkbox change
$(".brand").on("change", function () {
    var selectedBrands = [];
    $(".brand:checked").each(function () {
        selectedBrands.push($(this).val());
    });
    table.brand = selectedBrands;
    filter("brand", selectedBrands.toString());
});

// Price radio change
$(".price").on("change", function () {
    let price = $(this).val();
    table.price = price;
    filter("price", price);
});

// Pagination change
$(".per_page").on("change", function () {
    let paginate = $(this).val();
    table.paginate = paginate;
    filter("paginate", paginate);
});

// Sorting
$(document).on("click", ".sorting", function () {
    var column = $(this).data("column");
    var sort = $(this).data("sort");
    table.sortBy = column;
    table.sortOrder = sort;
    applyFilters();
});

// Specification filters change
$(".specifications").on("change", function () {
    let selectedFilters = {};

    $(".specifications:checked").each(function () {
        let fullId = $(this).attr("id"); // e.g., checkbox-10-red
        let parts = fullId.split("-");
        let filterId = parts[1];
        let value = $(this).val();

        if (!selectedFilters[filterId]) {
            selectedFilters[filterId] = [];
        }
        selectedFilters[filterId].push(value);
    });

    let specsArray = Object.entries(selectedFilters).map(([id, values]) => {
        return { id: id, values: values };
    });

    table.specifications = specsArray;
    filter("specifications", encodeURIComponent(JSON.stringify(specsArray)));
});

// Helpers
function updateSortLabel() {
    var checkedLabel = $('input[name="sorting"]:checked').next("span").text();
    $("#sort_label").text(checkedLabel);
}

function filter(key, value) {
    let uri = window.location.href;
    let url = "";
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf("?") !== -1 ? "&" : "?";
    if (uri.match(re)) {
        url = uri.replace(re, "$1" + key + "=" + value + "$2");
    } else {
        url = uri + separator + key + "=" + value;
    }
    window.location.href = url;
}

function applyFilters() {
    let uri = window.location.href;
    let params = new URLSearchParams(window.location.search);
    if (table.is_best_seller) params.set("is_best_seller", table.is_best_seller);
    if (table.is_new) params.set("is_new", table.is_new);
    if (table.brand) params.set("brand", table.brand);
    if (table.price) params.set("price", table.price);
    if (table.sortOrder !== "") params.set("order", table.sortOrder);
    if (table.sortBy !== "") params.set("sort", table.sortBy);
    if (table.specifications.length > 0) {
        params.set("specifications", encodeURIComponent(JSON.stringify(table.specifications)));
    }
    window.location.href = uri.split("?")[0] + "?" + params.toString();
}
