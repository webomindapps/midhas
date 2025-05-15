<header>
    <div class="">
        <div class="announcement_bar text-white text-center text_inter">🎆 New Year Special! Buy One, Get One Free
            +
            Free Shipping on All Orders – Celebrate 2025 with Big Savings! 🎉
        </div>
    </div>
    <div class="col-12 header_top text-center text_hind position-relative">
        <div class="section py-4">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="col-md-5 text-start search_action">
                    <a href="" class="text-uppercase fw-bold d-sm-block d-none"><i
                            class="fa-regular fa-envelope me-2"></i> info@midhafurniture.com</a>
                    <div class="collapse show" id="search_collapse">
                        <form class="d-flex mt-2 w-75" aria-labelledby="form-title">
                            <!-- Form Title (for accessibility) -->
                            <h2 id="form-title" class="visually-hidden">Search product Form</h2>

                            <!-- Input field with aria-label for better accessibility -->
                            <input type="text" class="form-control text-dark border-end-0"
                                placeholder="What can we help you find" aria-label="Text input field"
                                aria-required="true" aria-describedby="input-text-description" id="search-input">

                            <!-- Submit button with aria-label for better accessibility -->
                            <button class="btn text-white" type="submit" aria-label="Submit the form">
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                                    <path
                                        d="m25.753 24.586-6.712-6.606c1.757-1.91 2.837-4.436 2.837-7.215C21.879 4.819 16.98 0 10.939 0 4.899 0 0 4.82 0 10.765S4.897 21.53 10.939 21.53a11 11 0 0 0 6.885-2.404l6.739 6.631a.85.85 0 0 0 1.19 0 .82.82 0 0 0 0-1.172M10.94 19.874c-5.112 0-9.256-4.078-9.256-9.11 0-5.03 4.144-9.108 9.256-9.108s9.256 4.078 9.256 9.109-4.144 9.109-9.256 9.109"
                                        fill="#fff" />
                                </svg>
                            </button>
                        </form>
                        <div class="search-results" style="display: none;">
                            <ul class="list-styled" id="searched-item-List">
                                {{-- dynamic searched items --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 position-relative">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('frontend/images/midhas_logo.png') }}" alt="midhas_logo"
                            class="img-fluid w-100">
                    </a>
                    <a class="btn btn-search_toggle collapsed d-sm-none d-block position-absolute top-50 end-0 translate-middle-y"
                        data-bs-toggle="collapse" href="#search_collapse" role="button" aria-expanded="false"
                        aria-controls="search_collapse"> <i class="fa-solid fa-magnifying-glass"></i> </a>
                </div>
                <div class="col-md-5 right_side_action">
                    <div class="d-flex text-center justify-content-end align-items-center">
                        <div class="login header_login">
                            <a href="!#">
                                <i class="fa-solid fa-user d-block"></i>
                                <span class="d-block">{{ !Auth::check() ? 'Login' : 'Account' }}</span>
                            </a>
                            <div class="account__dropdown">
                                <div class="dropdown__inner">
                                    @if (!Auth::check())
                                        <ul class="no-bullet account__ul">
                                            <li class="account__ul--li">
                                                <a href="{{ route('customer.login') }}" class="">
                                                    <i class='bx bxs-user'></i>
                                                    <span class="dropdown__text"> Account </span>
                                                </a>
                                            </li>
                                            <li class="account__ul--li">
                                                <a href="{{ route('customer.login') }}" class="">
                                                    <i class='bx bxs-basket'></i>
                                                    <span class="dropdown__text"> Orders </span>
                                                </a>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="no-bullet account__ul">
                                            <li class="account__ul--li">
                                                <a href="#" class="">
                                                    <i class='bx bxs-user'></i>
                                                    <span class="dropdown__text"> Profile </span>
                                                </a>
                                            </li>
                                            <li class="account__ul--li">
                                                <a href="#" class="">
                                                    <i class='bx bxs-basket'></i>
                                                    <span class="dropdown__text"> Orders </span>
                                                </a>
                                            </li>
                                            <li class="account__ul--li">
                                                <a href="{{ route('customer.logout') }}" class="">
                                                    <i class='bx bx-power-off'></i>
                                                    <span class="dropdown__text"> Log Out </span>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="wishlist ms-4">
                            <a href="{{ route('wishlist.index') }}"> <i class="fa-solid fa-heart d-block"></i><span
                                    class="d-block">Wishlist</span></a>
                        </div>
                        <div class="cart ms-4 hover-box" id="miniCart">
                            <a href="{{ route('cart') }}"><i class="fa-solid fa-basket-shopping"></i><span
                                    class="d-block">My
                                    Cart</span></a>
                        </div>
                        <div class="collapse" id="hovedCart"></div>


                    </div>

                </div>
                <div class="mini_cart hover-box">
                    @if ($cart && $cart->items->count())

                        <div class="d-flex bag_title align-items-center justify-content-between">
                            <a href="{{ route('cart') }}" class="fw-bold text-uppercase mc_title">
                                Bag Summary (<span>{{ $cart->items->count() }}</span>)
                            </a>
                            <a href="{{ route('cart') }}" class="fw-bold text-uppercase mc_btn d-md-none d-block">
                                View Full Bag
                            </a>
                        </div>

                        <div class="bag_wrapper">
                            @foreach ($cart->items as $item)
                                <div class="bag_items">
                                    <div class="bag_prd_img">
                                        <img src="{{ asset($item->product->thumbnail) }}" alt="{{ $item->name }}"
                                            class="img-fluid">
                                    </div>
                                    <div class="bag_prd_info text-start">
                                        <div class="bag_prd_info_title">
                                            <a href="" class="d-inline-block pb-1">
                                                {{ $item->name }}
                                            </a>
                                            <p class="bag_prd_info_price mb-1">
                                                <b>${{ number_format($item->price, 2) }}</b>
                                            </p>
                                            <small class="bag_prd_info_qty">Qty: {{ $item->quantity }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex bag_total py-3 align-items-center justify-content-between">
                            <p class="fw-bold text-uppercase mc_title mb-0">Total</p>
                            <p class="fw-bold text-uppercase mc_title mb-0" id="grand_total">
                                ${{ number_format($cart->grand_total, 2) }}
                            </p>
                        </div>

                        <a href="" class="theme_btn text-uppercase d-block text-white">CheckOut</a>
                    @else
                        <p class="text-center p-3">Your bag is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 header_main text-center text_hind">
        <div class="section py-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg py-0 text_hind fw-bold text-uppercase">
                    <div class="container-fluid p-0">
                        <!-- Navbar Brand -->
                        <a class="navbar-brand d-none" href="#">Navbar</a>

                        <!-- Navbar Toggle for small screens -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar Links -->
                        <div class="collapse navbar-collapse p-0" id="navbarNav">
                            <ul class="navbar-nav justify-content-between w-100">
                                @foreach ($categories as $category)
                                    <li class="nav-item has_megamenu">
                                        <a class="nav-link"
                                            href="{{ route('productByCategory', $category->slug) }}">{{ $category->name }}</a>

                                        @if ($category->children->count())
                                            <div class="megamenu_wrapper">
                                                <div class="col sub_menu d-flex">
                                                    @php
                                                        $subCategoryChunks = $category->children->chunk(3);
                                                    @endphp

                                                    @foreach ($subCategoryChunks as $chunk)
                                                        <div class="col-md-2">
                                                            @foreach ($chunk as $subCategory)
                                                                <ul class="menu_list">
                                                                    <li class="drop-down__title">
                                                                        <span>{{ $subCategory->name }}</span>
                                                                    </li>
                                                                    @foreach ($subCategory->children as $child)
                                                                        <li><a
                                                                                href="{{ route('productByCategory', $child->slug) }}">{{ $child->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                    <li><a href="#">All
                                                                            <span>{{ $subCategory->name }}</span></a>
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        </div>
                                                    @endforeach

                                                    <div class="col-md-8">
                                                        <div class="d-flex image_nav_links">
                                                            <a href="#">
                                                                <img src="https://www.bigfurniturewarehouse.com/images/modules/promo_units/1726752394-26306500.png"
                                                                    alt="" class="img-fluid">
                                                            </a>
                                                            <a href="#">
                                                                <img src="https://www.bigfurniturewarehouse.com/images/modules/promo_units/1726752657-06734000.png"
                                                                    alt="" class="img-fluid">
                                                            </a>
                                                            <a href="#">
                                                                <img src="https://www.bigfurniturewarehouse.com/images/modules/promo_units/1726752672-06318800.png"
                                                                    alt="" class="img-fluid">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    </li>
                                @endforeach

                                {{-- Static links --}}
                                <li class="nav-item">
                                    <a class="nav-link text_orange" href="#">New Arrivals</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-danger" href="#">* Sale *</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Coming Soon!</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-12 header_bottom text-center text_hind">
        <div class="container d-flex text-uppercase fw-bold">
            <div class="col">
                <a href=""><img src="{{ asset('frontend/images/truck.svg') }}" alt=""
                        class="img-fluid">Free Delivery on orders over £150</a>
            </div>
            <div class="col d-sm-inline-block d-none">
                <a href=""><img src="{{ asset('frontend/images/star.svg') }}" alt=""
                        class="img-fluid">CHECK OUT OUR REVIEWS</a>
            </div>
            <div class="col">
                <a href=""><img src="{{ asset('frontend/images/gift.svg') }}" alt=""
                        class="img-fluid">LOYALTY SCHEME - JOIN TODAY!</a>
            </div>
        </div>
    </div>

    <div
        class="view_cart-mobile d-sm-none d-block position-fixed d-flex align-items-center justify-content-between px-4 shadow">
        <a href="">
            <i class="fa-solid fa-home"></i>
        </a>
        <a href="">
            <i class="fa-solid fa-heart"></i>
        </a>
        <a href="login.php">
            <i class="fa-solid fa-user"></i>
        </a>
        <a href="" class="position-relative d-block">
            <span
                class="indicator position-absolute rounded-circle d-flex align-items-center justify-content-center">2</span>
            <i class="fa-solid fa-basket-shopping"></i>
        </a>
    </div>
    @push('scripts')
        <script>
            const boxes = document.querySelectorAll('.hover-box');
            const mini_cart = document.querySelector('.mini_cart');
            var mobile_cart = document.getElementById('mob_cart');

            boxes.forEach(box => {
                const toggleHover = () => mini_cart.classList.add('hovered');
                box.addEventListener('mouseenter', toggleHover);
            });

            mobile_cart.addEventListener('click', () => {
                mini_cart.classList.toggle('hovered');
            });

            document.body.addEventListener('mousemove', (e) => {
                const isOverBox = [...boxes].some(box => box.contains(e.target));

                if (!isOverBox) {
                    boxes.forEach(box => mini_cart.classList.remove('hovered'));
                }
            });
        </script>
    @endpush

</header>
