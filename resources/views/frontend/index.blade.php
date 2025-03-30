@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <div class="slider">
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
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">New Arrivals</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>
        </div>
        <div class="row pb-5">
            @foreach ($products->take(6) as $product)
                <div class="col-2">
                    <div class="card item-card product-card overflow-hidden zoom-in-on-hover-sm shadow">
                        <img src="{{ $product->image }}" class="img-fluid product-img">
                        <div class="card-body text-start">
                            <div class="d-flex flex-column justify-content-between">
                                <h6 class="text-black">{{ $product->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                        <p class="text-muted"><s>${{ number_format($product->compare_price, 2) }}</s></p>
                                    @endif
                                    <h6 class="text-secondary ms-2">${{ number_format($product->price, 2) }}</h6>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{ route('product', $product->name) }}" class="btn btn-tertiary mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-4">
                <a href="" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/3-grid.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/3-grid.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="" class="card home-card shadow zoom-in-on-hover-sm">
                    <img src="{{ asset('frontend/images/3-grid.jpg') }}" alt="" class="img-fluid secondary-img">
                    <div class="card-body-2">
                        <div class="btn btn-secondary zoom-in-on-hover">View More</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <a href="">
        <img src="{{ asset('frontend/images/banner.png') }}" alt="Banner" class="img-fluid w-100vw mb-5">
    </a>
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 justify-content-between d-flex pb-3">
                <h4 class="text-black">Browse Your Favorite Authors</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>
            @foreach ($products->take(4) as $product)
                <div class="col-3">
                    <a href="{{ route('shop') }}"
                        class="card item-card product-card overflow-hidden zoom-in-on-hover-sm shadow text-decoration-none">
                        <img src="{{ $product->image }}" class="img-fluid product-img">
                        <div class="card-body text-center">
                            <div class="d-flex flex-column justify-content-between">
                                <h6 class="text-black">{{ $product->name }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection