<div class="bg-tertiary text-center py-1 overflow-hidden">
    <div class="announcement-slider">
        <p class="text-white text-shadow-tertiary-sm mb-0">We provide delivery all over Lebanon!</p>
        <p class="text-white text-shadow-tertiary-sm mb-0">We're ready to serve you 24/7</p>
        <p class="text-white text-shadow-tertiary-sm mb-0">Shop your Favorite Books Online</p>
    </div>
</div>
<div class="bg-white border-bottom">
    <div class="d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('home')}}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="Watania Logo" class="logo" />
        </a>
        <div class="position-relative py-4 ms-md-4">
            <div class="align-items-center desktop-display">
                <input type="text" class="input form-control search-bar ps-3 box-shadow" name="q" id="searchInput"
                    placeholder="Type To Search" autocomplete="off">
                <a class="nav-link y-on-hover ms-2" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
                    id="cartButton" aria-controls="offcanvasCart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div class="align-items-center tab-display">
                <input type="text" class="form-control input px-5" name="q" id="searchInput"
                    placeholder="Type To Search" autocomplete="off">
                <a class="nav-link y-on-hover ms-2" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
                    id="cartButton" aria-controls="offcanvasCart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div id="searchResults" class="list-group position-absolute w-100 mt-1 shadow bg-white"></div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="navbar-nav ms-auto m-display">
        <input type="text" class="form-control input px-5" name="q" id="searchInput" placeholder="Type To Search"
            autocomplete="off">
        <div class="nav-item">
            <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
                aria-controls="offcanvasCart">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center shadow border-bottom py-3" id="navbarNav">
        <ul class="navbar-nav text-center text-wrap">
            <div class="m-display flex-column text-center">
                <li class="nav-item"><a href="{{ route('home') }}"
                        class="text-decoration-none nav-link y-on-hover">Home</a>
                </li>
                <li class="nav-item"><a href="{{ route('contact') }}"
                        class="text-decoration-none nav-link y-on-hover">Contact</a>
            </div>
            <li class="nav-item"><a href="{{ route('shop') }}" class="text-decoration-none nav-link">All
                    Products</a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item"><a class="text-decoration-none nav-link"
                        href="{{ route('shop', ['category' => $category->name]) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>

    </div>
</nav>