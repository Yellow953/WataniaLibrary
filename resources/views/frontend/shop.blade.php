@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="row mt-4">
            @foreach($products as $product)
            <div class="col-6 col-md-3 mb-3">
                <a href="{{ route('product', $product->name) }}" class="text-decoration-none">
                    <div class="card item-card product-card overflow-hidden y-on-hover">
                        <img src="{{ $product->image }}" class="img-fluid product-img">
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-between">
                                <h5 class="text-black">{{ $product->name }}</h5>
                                <p class="text-muted">{{ $product->category->name }}</p>
                                <div class="d-flex justify-content-end">
                                    @if ($product->compare_price)
                                    <h6 class="text-muted"><s>${{ number_format($product->compare_price, 2)
                                            }}</s></h6>
                                    @endif
                                    <h5 class="text-secondary ms-2">${{ number_format($product->price, 2) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex flex-column y-on-hover">
                                <a href="{{ route('product', $product->name) }}" class="btn btn-tertiary mt-3">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
@endsection