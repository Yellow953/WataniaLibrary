@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')
    <div class="container pb-4">
        <div class="row pt-4 pb-5">
            <div class="col-12 text-center">
                <h1 class="text-primary">About Us</h1>
                <h5>Welcome to Wataniya Library your one-stop destination for books, stationery, educational toys, and
                    photocopying services since 1993.
                </h5>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-6 d-flex align-items-center">
                <h5 class="text-center lh-lg">For over three decades, we've been proud to serve our community by providing a
                    wide
                    selection of new and
                    used books, quality stationery, educational toys, and professional photocopying services. Whether you're
                    a
                    student, a parent, a teacher, or a book enthusiast, we have everything you need to fuel learning,
                    creativity, and growth.
                </h5>
            </div>
            <div class="col-6">
                <img src="{{ asset('frontend/images/about-1.jpg') }}" alt="" class="img-fluid rounded-4 shadow">
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-12 text-center">
                <h1 class="text-primary">Our services and offerings include</h1>
            </div>
            <div class="col-6 d-flex align-items-center">
                <img src="{{ asset('frontend/images/about-2.jpg') }}" alt="" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-6 d-flex flex-column justify-content-center pt-3">
                <h3 class="pb-2 text-primary">Books</h3>
                <h5 class="pb-3">Explore our diverse collection of school books (both new and used), from
                    textbooks
                    to educational literature. We also offer a broad selection of fiction and non-fiction titles for readers
                    of all ages.
                </h5>
                <h3 class="pb-2 text-primary">Stationary</h3>
                <h5 class="pb-3">Find top-quality school, office, and personal supplies to meet your everyday
                    needs.
                </h5>
                <h3 class="pb-2 text-primary">Educational Toys</h3>
                <h5 class="pb-3">A variety of educational toys designed to stimulate creativity, critical
                    thinking,
                    and learning for children of all ages.
                </h5>
                <h3 class="pb-2 text-primary">Photocopying</h3>
                <h5 class="pb-3">Quick and reliable photocopying services for documents of all sizes, tailored
                    to your personal or professional needs.
                </h5>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-12 align-items-center d-flex justify-content-center">
                <img src="{{ asset('frontend/images/about-3.jpg') }}" alt="" class="img-fluid w-50 mb-5 rounded-4 shadow">
            </div>
            <div class="col-12 text-center">
                <h5>At Wataniya Library, we are committed to supporting education, creativity, and lifelong learning. We
                    offer a warm, welcoming environment for students, parents, educators, and all those passionate about
                    knowledge and discovery.<br>
                    <br>
                    Thank you for choosing Wataniya Library —where books, learning, and creativity come together. We look
                    forward to serving you!
                </h5>

            </div>
        </div>
    </div>
@endsection