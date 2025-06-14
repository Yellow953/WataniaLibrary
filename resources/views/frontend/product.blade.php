@extends('frontend.layouts.app')

@section('title', ucwords($product->name))

@section('content')
<section class="pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card mb-3 position-relative overflow-hidden">
                    <img class="card-img img-fluid border-custom" src="{{ asset($product->image) }}" alt="Product image"
                        id="product-detail">
                </div>

                @if ($product->secondary_images)
                <div class="row">
                    <div id="multi-item-example" class="col-12 carousel slide carousel-multi-item pointer-event"
                        data-bs-ride="carousel">
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <div class="carousel-item active">
                                <div class="row">
                                    @if ($product->secondary_images->count() != 0)
                                    <div class="col-4 p-2">
                                        <a href="#" class="secondary-image" data-image="{{ asset($product->image) }}">
                                            <img class="card-img border-custom secondary-img border img-fluid"
                                                src="{{ asset($product->image) }}">
                                        </a>
                                    </div>
                                    @endif
                                    @foreach ($product->secondary_images as $image)
                                    <div class="col-4 p-2">
                                        <a href="#" class="secondary-image" data-image="{{ asset($image->path) }}">
                                            <img class="card-img border-custom secondary-img border img-fluid"
                                                src="{{ asset($image->path) }}">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2 text-primary text-shadow">{{ $product->name }}</h1>
                        <div class="my-3">
                            <div class="d-flex justify-content-between my-2">
                                <span class="fw-bold">Category:</span> {{ $product->category->name }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-content-center">
                            <div class="fw-bold">Price</div>
                            <div><span class="fs-5 fw-bold text-primary text-shadow-sm">${{
                                    number_format($product->price) }}</span>
                                @if ($product->compare_price)
                                <span
                                    class="fs-7 text-muted text-decoration-line-through">${{number_format($product->compare_price)
                                    }}</span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="mt-3 w-100 d-flex flex-column">
                            {{-- @foreach ($product->variants as $variant)
                            <div class="form-group mb-3">
                                <label class="form-label">{{ ucwords($variant->title) }}</label>
                                <select class="form-select" name="variant[{{$variant->id}}]"
                                    id="variant_{{$variant->id}}" required>
                                    <option value=""></option>
                                    @foreach ($variant->options as $option)
                                    <option value="{{ $option->value }}" data-price="{{ $option->price }}">{{
                                        $option->value
                                        }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach --}}

                            <div class="form-group">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" min="0" step="1" value="1" name="quantity" id="quantity"
                                    class="form-control my-2" required>
                            </div>

                            <a href="#" id="addToCart" class="btn btn-tertiary my-2 shake">
                                Add To Cart <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="#" id="buyNow" class="btn btn-primary my-2 shake">
                                Buy Now <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($product->description)
                <div class="card mt-4">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button text-primary fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                    aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                    Description
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    {{ $product->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <h2 class="my-4 text-center text-primary text-shadow">Similar Products</h2>

            <div id="multi-item-example" class="col-12 carousel slide carousel-multi-item pointer-event"
                data-bs-ride="carousel">
                <div class="carousel-inner product-links-wap" role="listbox">
                    @foreach ($simillar_products->chunk(6) as $key => $chunk)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($chunk as $pr)
                            <div class="col-4 col-md-2">
                                <div class="card border-custom">
                                    <a href="{{ route('product', $pr->name) }}" class="text-decoration-none">
                                        <img class="card-img border img-fluid" src="{{ asset($pr->image) }}"
                                            alt="{{ $pr->name }}">
                                        <h5 class="text-center text-primary text-shadow-sm mt-2">{{ $pr->name }}</h5>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const product = {
            id: "{{ $product->id }}",
            name: "{{ $product->name }}",
            image: "{{ asset($product->image) }}",
            price: "{{ $product->price }}",
        };

        const addToCartBtn = document.getElementById('addToCart');
        const buyNowBtn = document.getElementById('buyNow');
        const quantityInput = document.getElementById('quantity');

        function getCart() {
            const cart = document.cookie
                .split('; ')
                .find(row => row.startsWith('cart='))
                ?.split('=')[1];
            return cart ? JSON.parse(decodeURIComponent(cart)) : [];
        }

        function saveCart(cart) {
            document.cookie = `cart=${encodeURIComponent(JSON.stringify(cart))}; path=/; max-age=${30 * 24 * 60 * 60}`;
        }

        addToCartBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const quantity = parseInt(quantityInput.value) || 1;

            let cart = getCart();

            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({ ...product, quantity });
            }

            saveCart(cart);
            alert('Product added to cart!');
        });

        buyNowBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const quantity = parseInt(quantityInput.value) || 1;

            let cart = getCart();

            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({ ...product, quantity });
            }

            saveCart(cart);

            window.location.href = "{{ route('shop.checkout') }}";
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const secondaryImages = document.querySelectorAll('.secondary-image');
        const mainImage = document.getElementById('product-detail');

        secondaryImages.forEach(image => {
            image.addEventListener('click', function(event) {
                event.preventDefault();
                const newImageSrc = this.getAttribute('data-image');
                mainImage.setAttribute('src', newImageSrc);
            });
        });
    });
</script>
@endsection