@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="slider position-relative">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <a href="{{ route('shop') }}">
                    <img src="{{ asset('frontend/images/hero-1.png') }}" class="d-block hero-img" alt="Hero Image">
                </a>
            </div>
            <div class="carousel-item">
                <a href="{{ route('shop') }}">
                    <img src="{{ asset('frontend/images/hero-2.png') }}" class="d-block hero-img" alt="Hero Image">
                </a>
            </div>
            <div class="carousel-item active">
                <a href="{{ route('shop') }}">
                    <img src="{{ asset('frontend/images/hero-3.png') }}" class="d-block hero-img" alt="Hero Image">
                </a>
            </div>
        </div>
        <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y" type="button"
            data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y" type="button"
            data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container py-5">
    <section>
        <div class="row">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Art Materials</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($art_materials as $art_material)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $art_material->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $art_material->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($art_material->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $art_material->name) }}"
                                    class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-1.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-2.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-3.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-5">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Backpacks</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($backpacks as $backpack)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $backpack->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $backpack->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($backpack->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $backpack->name) }}"
                                    class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
<a href="">
    <img src="{{ asset('frontend/images/banner.png') }}" alt="Banner" class="img-fluid w-100vw mb-5">
</a>
<div class="container pb-5">
    <section>
        <div class="row">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Lunchbag & LunchBox</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($lunchs as $lunch)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $lunch->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $lunch->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($lunch->price, 2) }}</div>
                                </div>
                                <a href="{{ route('product', $lunch->name) }}" class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-4.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-5.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <a href="#" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/grid-6.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-5">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Pencil Cases</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($pencil_cases as $pencil_case)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $pencil_case->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $pencil_case->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($pencil_case->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $pencil_case->name) }}"
                                    class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-5">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Stationaries</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($stationaries as $stationary)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $stationary->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $stationary->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($stationary->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $stationary->name) }}"
                                    class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-5">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Toys</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($toys as $toy)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $toy->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $toy->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($toy->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $toy->name) }}" class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-5">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Water Bottles</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($water_bottles as $water_bottle)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $water_bottle->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $water_bottle->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($water_bottle->price, 2) }}
                                    </div>
                                </div>
                                <a href="{{ route('product', $water_bottle->name) }}"
                                    class="btn btn-tertiary w-100 mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection