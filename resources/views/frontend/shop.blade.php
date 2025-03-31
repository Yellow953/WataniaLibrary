@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="pb-5">
        <div class="container">
            <div class="row mt-4">
                <div class="col-3 desktop-display">
                    <div class="card card-filter px-3 pt-4 pb-5 rounded-4">
                        <h5 class="mb-3 tex-center">Filter Products</h5>
                        <form method="GET" action="{{ route('shop') }}">
                            <!-- Category Filter -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select input" id="category" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="mb-3">
                                <label for="price_min" class="form-label">Price Range</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2 input" id="price_min" name="price_min"
                                        placeholder="Min" value="{{ request('price_min') }}">
                                    <input type="number" class="form-control input" id="price_max" name="price_max"
                                        placeholder="Max" value="{{ request('price_max') }}">
                                </div>
                            </div>

                            <!-- Sort By -->
                            <div class="mb-3">
                                <label for="sort_by" class="form-label">Sort By</label>
                                <select class="form-select input" id="sort_by" name="sort_by">
                                    <option value="">Default</option>
                                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price:
                                        Low to High
                                    </option>
                                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                                        Price: High to Low
                                    </option>
                                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name: A
                                        to Z</option>
                                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name:
                                        Z to A</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row">
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
                                                        <h6 class="text-muted">
                                                            <s>${{ number_format($product->compare_price, 2)
                                                                                                                                                                                                                                                                                                                                                                                                                                            }}</s>
                                                        </h6>
                                                    @endif
                                                    <h5 class="text-secondary ms-2">${{ number_format($product->price, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column y-on-hover">
                                                <a href="{{ route('product', $product->name) }}"
                                                    class="btn btn-tertiary mt-3">View
                                                    Product</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection