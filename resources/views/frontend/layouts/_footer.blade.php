<footer>
    <div class="container row pt-5 bg-white">
        <div class="col-3">
            <h5 class="text-primary text-center pb-1">Customer Service</h5>
            <ul class="text-black navbar-nav text-center">
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">Find Us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">FAQ</a>
                </li>
            </ul>
        </div>
        <div class="col-3">
            <h5 class="text-primary text-center pb-1">About Us</h5>
            <ul class="text-black navbar-nav text-center">
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">Our Company</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="text-decoration-none text-black">Terms Of Use</a>
                </li>
            </ul>
        </div>
        <div class="col-6">
            <h5 class="text-primary text-start pb-1">Stay updated with the latest releases and offers</h5>
            <input type="text" class="form-control input pe-5 text-start" name="q" id="searchInput"
                placeholder="Enter Your Email" autocomplete="off">
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center pt-5 gap-4">
        <h2><i class="fa-brands fa-facebook text-black"></i></h2>
        <h2><i class="fa-brands fa-x-twitter text-black"></i></h2>
        <h2><i class="fa-brands fa-instagram text-black"></i></h2>
    </div>
    <div class="col-12 justify-content-center text-center pt-2">
        <a class="navbar-brand" href="{{ route('home')}}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="Watania Logo" class="logo" />
        </a>
        <p>Copyright © 2025 Watania Library. All rights reserved.</p>
    </div>
    <div class="bg-black pt-1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center text-white py-2">
                        Powered By
                        <a href="https://yellowtech.dev" class="text-primary text-decoration-none fw-bold mx-1"
                            target="_blank">YellowTech</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>