@props(['categories', 'subcategories'])

<div class="sidebar">
    <ul class="list-group border-0 text_hind">
        <li class="list-group-item">
            <a class="btn btn-category">Your Selection</a>
            <div class="card card-body bg-white">
                <p class="mb-0">
                    <span class="fw-medium">Categories:</span>
                    @foreach ($categories as $category)
                        {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
                <p class="mb-0">
                    <span class="fw-medium">Subcategories:</span>
                    @foreach ($subcategories as $subcategory)
                        {{ $subcategory->name }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
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
                    @foreach ($subcategories as $subcategory)
                        <div class="form-check">
                            <!-- Add category-checkbox class for easier targeting in JavaScript -->
                            <input class="form-check-input category-checkbox" type="checkbox"
                                value="{{ $subcategory->id }}" id="subcat-{{ $subcategory->id }}">
                            <label class="form-check-label" for="subcat-{{ $subcategory->id }}">
                                {{ $subcategory->name }}
                            </label>
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
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                            <label class="form-check-label" for="flexCheckDefault5">
                                {{ $brand->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </li>
        <li class="list-group-item">
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
            <a class="btn btn-category collapsed" data-bs-toggle="collapse" href="#collapseExample4" role="button"
                aria-expanded="false" aria-controls="collapseExample4"> Price <i
                    class="fa-solid fa-plus pt-1 float-end"></i> </a>
            <div class="collapse" id="collapseExample4">
                <div class="card card-body bg-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            Under 500
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            550 - 1000
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                        <label class="form-check-label" for="flexCheckDefault5">
                            1050 - 2500
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
        </li>
    </ul>
</div>
<script>
    $(document).ready(function() {
        // Filter products by category selection
        $('input[type="checkbox"].category-checkbox').on('change', function() {
            filterProducts();
        });

        // Filter products by brand selection
        $('input[type="checkbox"].brand-checkbox').on('change', function() {
            filterProducts();
        });

        function filterProducts() {
            var selectedCategories = [];
            var selectedBrands = [];

            // Collect selected categories
            $('input[type="checkbox"].category-checkbox:checked').each(function() {
                selectedCategories.push($(this).val());
            });

            // Collect selected brands
            $('input[type="checkbox"].brand-checkbox:checked').each(function() {
                selectedBrands.push($(this).val());
            });

            // Loop through all products and filter them
            $('.products_list_box .item').each(function() {
                var productCategories = $(this).data('categories').split(
                ','); // Assuming you store product categories in data attributes
                var productBrands = $(this).data('brands').split(
                ','); // Assuming you store product brands in data attributes

                var showProduct = false;

                // Check if product matches selected categories and brands
                if (
                    (selectedCategories.length === 0 || selectedCategories.some(category =>
                        productCategories.includes(category))) &&
                    (selectedBrands.length === 0 || selectedBrands.some(brand => productBrands.includes(
                        brand)))
                ) {
                    showProduct = true;
                }

                // Show or hide the product based on the filter
                if (showProduct) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>
