@props(['categories', 'subcategories', 'cat'])

<div class="sidebar">
    <ul class="list-group border-0 text_hind">
        <li class="list-group-item">
            <a class="btn btn-category">Your Selection</a>
            <div class="card card-body bg-white">
                <p class="mb-0"><span class="fw-medium">Type :</span> {{ $cat->name }}</p>
            </div>
        </li>

        <!-- Departments Section with Checkboxes -->
        <li class="list-group-item">
            <a class="btn btn-category" data-bs-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="true" aria-controls="collapseExample">
                Departments <i class="fa-solid fa-plus pt-1 float-end"></i>
            </a>
            <div class="collapse show" id="collapseExample">
                <div class="card card-body bg-white">
                    @foreach ($subcategories as $category)
                        <div class="form-check">
                            <a href="{{ route('productByCategory', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample1" role="button"
                aria-expanded="false" aria-controls="collapseExample1"> Brands <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample1">
                <div class="card card-body bg-white">
                    @foreach ($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input brand" type="checkbox" name="brand"
                                value="{{ $brand->id }}" id="flexCheckDefault-{{ $brand->id }}">
                            <label class="form-check-label" for="flexCheckDefault-{{ $brand->id }}">
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample4" role="button"
                aria-expanded="false" aria-controls="collapseExample4"> Price <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample4">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="0-500" id="price1">
                        <label class="form-check-label" for="price1">
                            Under 500
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="550-1000" id="price2">
                        <label class="form-check-label" for="price2">
                            550 - 1000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input price" type="radio" name="price_limit" value="1050-2500" id="price3">
                        <label class="form-check-label" for="price3">
                            1050 - 2500
                        </label>
                    </div>
                </div>
            </div>
        </li>
        {{-- <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample2" role="button"
                aria-expanded="false" aria-controls="collapseExample2"> Size <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample2">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Single Seater
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked6">
                        <label class="form-check-label" for="flexCheckChecked6">
                            2 Seater (102)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                        <label class="form-check-label" for="flexCheckDefault7">
                            3 Seater (32)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked8">
                        <label class="form-check-label" for="flexCheckChecked8">
                            5 Seater (52)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9">
                        <label class="form-check-label" for="flexCheckDefault9">
                            6 Seater (38)
                        </label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample3" role="button"
                aria-expanded="false" aria-controls="collapseExample3"> Assembly <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample3">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Label 1
                        </label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample41" role="button"
                aria-expanded="false" aria-controls="collapseExample41"> Color <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample41">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Black (9)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Grey (70)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Brown (2)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Blue (20)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Green (1)
                        </label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample5" role="button"
                aria-expanded="false" aria-controls="collapseExample5"> Material <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample5">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Cotton (9)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Polyester (4)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Velvet (2)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Spandex (20)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Rexine (1)
                        </label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample6" role="button"
                aria-expanded="false" aria-controls="collapseExample6"> Number of Doors <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample6">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                        <label class="form-check-label" for="flexCheckDefault6">
                            Single Door (9)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                        <label class="form-check-label" for="flexCheckDefault7">
                            Double Door (4)
                        </label>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample6" role="button"
                aria-expanded="false" aria-controls="collapseExample6"> Number of Drawers <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample6">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                        <label class="form-check-label" for="flexCheckDefault6">
                            2 Drawers (9)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                        <label class="form-check-label" for="flexCheckDefault7">
                            4 Drawers (4)
                        </label>
                    </div>
                </div>
            </div>
        </li> --}}
    </ul>
</div>
@push('scripts')
    <script>
        var table = {
            is_new: '',
            is_best_seller: '',
            brand: '',
            price: '',
            sortBy: '',
            sortOrder: '',
            paginate: null,
        }

        $(document).ready(function() {
            let is_new = new URLSearchParams(window.location.search).get("is_new");
            let is_best_seller = new URLSearchParams(window.location.search).get("is_best_seller");
            let brands = new URLSearchParams(window.location.search).get("brand");
            let price = new URLSearchParams(window.location.search).get("price");
            let sale = new URLSearchParams(window.location.search).get("sale");
            let paginate = new URLSearchParams(window.location.search).get("paginate");
            let sort = new URLSearchParams(window.location.search).get("sort");
            let order = new URLSearchParams(window.location.search).get("order");
            if (brands) {
                $('.brand').each(function() {
                    var arr = brands.split(',');
                    if (arr.indexOf($(this).val()) !== -1) {
                        $(this).prop('checked', true);
                    }
                });
            }
            if (price) {
                $('.price').each(function() {
                    if ($(this).val() == price) {
                        $(this).prop('checked', true);
                    }
                });
            }
            if (sale) {
                if ($('#sale').val() == sale) {
                    $('#sale').prop('checked', true);
                }
            }

            table.paginate = paginate ? paginate : null;
            if (paginate) {
                $(".per_page").each(function() {
                    if ($(this).val() === paginate) {
                        $(this).prop('checked', true);
                    }
                });
                var checkedLabel = $('input[name="limit"]:checked').next('span').text();
                $('#limit_label').text(checkedLabel);
            } else {
                $(".per_page[value='100']").prop('checked', true);
            }

            if (sort && order && sort !== "" && order !== "") {
                $('.sorting').each(function() {
                    if ($(this).data('column') === sort && $(this).data('sort') === order) {
                        $(this).prop('checked', true);
                    }
                });
                updateSortLabel();
            }
        });
        $('.brand').on('change', function() {
            var selectedBrands = [];
            $('.brand:checked').each(function() {
                selectedBrands.push($(this).val());
            });
            table.brand = selectedBrands;
            filter('brand', selectedBrands.toString());
        });
        $('.price').on('change', function() {
            let price = $(this).val();
            table.price = price;
            filter('price', price);
        });
        $('.per_page').on('change', function() {
            let paginate = $(this).val();
            table.paginate = paginate;
            filter('paginate', paginate);
        });

        $(document).on('click', '.sorting', function() {
            var column = $(this).data('column');
            var sort = $(this).data('sort');
            table.sortBy = column;
            table.sortOrder = sort;
            applyFilters();
        });

        function updateSortLabel() {
            var checkedLabel = $('input[name="sorting"]:checked').next('span').text();
            $('#sort_label').text(checkedLabel);
        }


        function filter(key, value) {
            let uri = window.location.href
            let url = '';
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                url = uri.replace(re, '$1' + key + "=" + value + '$2');
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
            if (table.sortOrder !== '') params.set("order", table.sortOrder);
            if (table.sortBy !== '') params.set("sort", table.sortBy);
            window.location.href = uri.split('?')[0] + '?' + params.toString();
        }
    </script>
@endpush
