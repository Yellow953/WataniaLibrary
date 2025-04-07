<div class="bg-white border-bottom">
    <div class="d-flex align-items-center justify-content-center justify-content-md-between">
        <a class="navbar-brand" href="{{ route('home')}}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="Watania Logo" class="logo" />
        </a>
        <div class="position-relative py-4 ms-md-2">
            <div class="desktop-display align-items-center">
                <ul class="navbar-nav text-wrap d-flex flex-row">
                    <li class="nav-item"><a href="{{ route('home') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">Home</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('about') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">About</a>
                    </li>
                    <li class="nav-item me-2"><a href="{{ route('contact') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">Contact</a>
                    </li>
                </ul>
                <input type="text" class="input form-control search-bar ps-3 box-shadow" name="q" id="searchInput"
                    placeholder="Type To Search" autocomplete="off">
                <a class="nav-link ms-2 me-3" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
                    id="cartButton" aria-controls="offcanvasCart">
                    <i class="fa-solid fa-cart-shopping py-2"></i>
                </a>
            </div>
            <div class="align-items-center tab-display">
                <ul class="navbar-nav text-wrap d-flex flex-row">
                    <li class="nav-item"><a href="{{ route('home') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">Home</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('about') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">About</a>
                    </li>
                    <li class="nav-item me-2"><a href="{{ route('contact') }}"
                            class="text-decoration-none nav-link zoom-in-on-hover-sm">Contact</a>
                    </li>
                </ul>
                <input type="text" class="form-control input px-5" name="q" id="searchInput"
                    placeholder="Type To Search" autocomplete="off">
                <a class="nav-link ms-2" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button" id="cartButton"
                    aria-controls="offcanvasCart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div id="searchResults" class="list-group position-absolute w-100 mt-1 shadow bg-white"></div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg fixed-top bg-nav-sticky megamenu">
    <button class="navbar-toggler border-0 ms-2 tab-end" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center shadow border-bottom py-3" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item text-center"><a href="{{ route('shop') }}"
                    class="text-decoration-none nav-link zoom-in-on-hover-sm">All
                    Products</a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item dropdown megamenu-fw text-center">
                    <div class="nav-link zoom-in-on-hover-sm">
                        <a class="text-decoration-none"
                            href="{{ route('shop') }}?category={{  $category->name }}">{{ $category->name }}</a>
                        <span class="dropdown-toggle caret" data-toggle="dropdown" role="button"
                            aria-expanded="false"></span>
                    </div>
                    <ul class="dropdown-menu megamenu-content bg-white-blur" role="menu">
                        <li>
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="title text-center text-md-start">{{ $category->name }}</h3>
                                    <ul class="list-unstyled">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li class="zoom-in-on-hover-sm"><a
                                                    href="{{ route('shop') }}?category={{ $subcategory->name }}"
                                                    class="text-decoration-none text-black">{{ $subcategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="title text-center text-md-start mt-3">Featured Products</h3>
                                    <ul class="list-unstyled">
                                        @foreach ($category->products->take(4) as $product)
                                            <li class="zoom-in-on-hover-sm"><a href="{{ route('product', $product->name) }}"
                                                    class="text-decoration-none text-black">{{ $product->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="title text-center text-md-start mt-3">Latest Products</h3>
                                    <ul class="list-unstyled">
                                        @foreach ($category->products->take(4) as $product)
                                            <li class="zoom-in-on-hover-sm"><a href="{{ route('product', $product->name) }}"
                                                    class="text-decoration-none text-black">{{ $product->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="navbar-nav ms-auto me-auto m-display">
        <input type="text" class="form-control input px-4" name="q" id="searchInput" placeholder="Type To Search"
            autocomplete="off">
    </div>
    <div class="nav-item m-display">
        <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
            aria-controls="offcanvasCart">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </div>
</nav>