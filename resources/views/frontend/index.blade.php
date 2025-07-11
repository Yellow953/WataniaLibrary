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
                <h4 class="text-black">Reading Books</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($products as $product)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $product->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $product->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                    <p class="text-muted mb-0"><s>${{ number_format($product->compare_price, 2) }}</s>
                                    </p>
                                    @endif
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <a href="{{ route('product', $product->name) }}"
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
                <h4 class="text-black">Scholar Books</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($products as $product)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $product->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $product->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                    <p class="text-muted mb-0"><s>${{ number_format($product->compare_price, 2) }}</s>
                                    </p>
                                    @endif
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <a href="{{ route('product', $product->name) }}"
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
                <h4 class="text-black">Browse Your Favorite Authors</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>
            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($products as $product)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $product->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $product->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                    <p class="text-muted mb-0"><s>${{ number_format($product->compare_price, 2) }}</s>
                                    </p>
                                    @endif
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <a href="{{ route('product', $product->name) }}"
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
                <h4 class="text-black">Stationaries</h4>
                <a href="{{ route('shop') }}" class="text-decoration-none text-primary">View All</a>
            </div>

            <div class="col-12 mb-5">
                <div class="owl-carousel product-carousel">
                    @foreach ($products as $product)
                    <div class="item px-2">
                        <div class="card border-custom item-card product-card overflow-hidden shadow">
                            <img src="{{ $product->image }}" class="img-fluid product-img">
                            <div class="card-body text-start">
                                <h6 class="text-black">{{ $product->name }}</h6>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                    <p class="text-muted mb-0"><s>${{ number_format($product->compare_price, 2) }}</s>
                                    </p>
                                    @endif
                                    <div class="text-secondary ms-2 mb-0">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <a href="{{ route('product', $product->name) }}"
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