<footer>
    <div class="container row pt-5 bg-white">
        <div class="col-md-4">
            <h5 class="text-primary text-center pb-1">Quick Links</h5>
            <ul class="text-black navbar-nav text-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-black">Home
                </li>
                <li class="nav-item">
                    <a href="{{ route('shop') }}" class="text-decoration-none text-black">Shop</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="text-decoration-none text-black">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="text-decoration-none text-black">About Us</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="text-primary text-center pb-1">Policies</h5>
            <ul class="text-black navbar-nav text-center">
                <li class="nav-item">
                    <a href="{{ route('privacy_policy') }}" class="text-decoration-none text-black">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('return_policy') }}" class="text-decoration-none text-black">Return Policy</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('terms_and_conditions') }}" class="text-decoration-none text-black">Terms &
                        Conditions</a>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="text-primary text-start pb-1">Stay updated with the latest releases and offers</h5>
            <input type="text" class="form-control input pe-5 text-start zoom-in-on-hover-sm" name="q" id="searchInput"
                placeholder="Enter Your Email" autocomplete="off">
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center pt-5 gap-4">
        <a href="#">
            <h2><i class="fa-brands fa-facebook text-black"></i></h2>
        </a>
        <a href="#">
            <h2><i class="fa-brands fa-x-twitter text-black"></i></h2>
        </a>
        <a href="#">
            <h2><i class="fa-brands fa-instagram text-black"></i></h2>
        </a>
    </div>
    <div class="col-12 justify-content-center text-center pt-2">
        <a class="navbar-brand" href="{{ route('home')}}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="Watania Logo" class="logo" />
        </a>
        <p>Copyright © 2025 Watania Library. All rights reserved.</p>
    </div>
</footer>