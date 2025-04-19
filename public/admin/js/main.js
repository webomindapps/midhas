
let categorySelected = [];
let product_id = document.getElementById('product_id')?.value;
let product_category_ids = document.getElementById('product_category_ids')?.value;

document.addEventListener("DOMContentLoaded", function () {
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let dropdownLinks = document.querySelectorAll(".dropdown");

    btn.onclick = function () {
        sidebar.classList.toggle("active");
    }

    dropdownLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            let dropdownMenu = this.querySelector(".dropdown_menu");
            dropdownMenu.classList.toggle("open");
        });
    });


    //get existing specifications
    if (product_id && product_category_ids) {
        JSON.parse(product_category_ids).map((category) => {
            categorySelected.push(category);
        })
        getSpecifications();
    }


    //get assign employees to order
    let store_id = $('#store_id').val();
    let employee_id = $('#existing_delivery_id').val();

    if (store_id && employee_id) {
        getEmployees(store_id)
        setTimeout(() => {
            $('#employee_id').val(employee_id);
        }, 1000);

    }
});

$(document).ready(function () {
    if ($('#session-success').hasClass('session-success')) {
        setTimeout(() => {
            $('#session-success').hide()
        }, 3000);
    }
    $(".profile-icon").click(function () {
        $(".profile-drop").toggle();
    });
});


$('.slug').on('change', function () {
    var val = $(this).val();
    var slug = val.replace(/\s/g, "-");
    $('#slug').val(slug.toLowerCase());
});


$(document).on('keypress', '.price', function (evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false;

    return true;
})


$('.image-file').on('change', function (e) {
    var id = $(this).attr('id');
    if (this.files && this.files.length > 0) {
        var src = URL.createObjectURL(e.target.files[0]);
    } else {
        src = '';
    }
    $('#preview-image-' + id + '').attr('src', src);
});

$('.multiple-images').on('change', function (e) {
    var preview_image = '';
    for (let i = 0; i < e.target.files.length; i++) {
        const image = e.target.files[i];
        var src = URL.createObjectURL(image);
        preview_image += `<img id="preview-image-${i}" src="${src}" class="removeImg" height="100px" width="100px" style="margin-left:10px;margin-right:10px;" />`;
    }
    $('#image-section').html("");
    $('#image-section').append(preview_image);

});


//getting specifications based on categories selected

let endpoint = window._url;

$(document).on('change', '.category', function () {
    var value = $(this).val()
    if ($(this).is(":checked")) {
        categorySelected.push(value);
    } else {
        let index = categorySelected.indexOf(value)
        if (index > -1) {
            categorySelected.splice(index, 1)
        }
    }
    getSpecifications();
})

const getSpecifications = () => {
    if (categorySelected.length > 0) {
        $.ajax({
            url: endpoint + '/admin/getSpecification',
            type: 'get',
            data: {
                ids: categorySelected,
                product_id,
            },
            success: function (data) {
                loadSpecification(data)
            }
        })
    }
    else {
        $('#specifications-contents').html("")
    }

}

const loadSpecification = (items) => {
    var data = '';

    items.map((item) => {
        data += `
            <tr>
                <td>
                    <label for="">${item.name}</label>
                </td>
                <td>
                    <input type="hidden" name="specification_id[]" value="${item.id}"  />
                    <input type="hidden" name="specification_name[]" value="${item.name}"  />
                    <input type="text" name="specification_value[]" value="${item.value}">
                </td>
            </tr>
        `;
    })

    $('#specifications-contents').html("")
    $('#specifications-contents').append(data)

}




//form submit functionality 
$(document).on('submit', '.formSubmit', function (e) {
    $('.submitBtn').attr('disabled', true)
    $(this).submit();
})

$(document).on('click', '.breadcrumbForm', function (e) {
    $(this).attr('disabled', true)
    $('#submitForm').submit();
})

$(document).on('change', '#store_id', function () {
    var store_id = $(this).val();
    getEmployees(store_id);
})


const getEmployees = (store_id) => {
    $.ajax({
        url: endpoint + '/admin/getEmployees',
        type: 'get',
        data: {
            store_id,
        },
        success: function (data) {
            let html = '<option value="">Select</option>';
            data.map((data) => {
                html += '<option value="' + data.id + '">' + data.first_name + ' ' + data.last_name + '</option>';
            })
            $('#employee_id').html("")
            $('#employee_id').append(html)
        }
    })
}