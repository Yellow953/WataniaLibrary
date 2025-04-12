<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JQuery (Load First) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <title>@yield('title') - Watania Library</title>
</head>

<body class="custom_scroller">
    @include('frontend.layouts._announcement')
    @include('frontend.layouts._header')

    @yield('content')

    @include('frontend.layouts._footer')
    @include('frontend.layouts._sponsor')
    @include('frontend.layouts._modals')

    <!-- WhatsApp Floating Button -->
    <div id="whatsapp">
        <a href="https://api.whatsapp.com/send?phone=96176925969" target="_blank">
            <img src="{{ asset('frontend/images/whatsapp.png') }}" alt="whatsapp logo" class="img-fluid">
        </a>
    </div>

    <!-- Custom JS -->
    <script src="{{ asset('frontend/js/megamenu.js') }}"></script>
    <script src="{{ asset('frontend/js/animations.js') }}"></script>
    <script src="{{ asset('frontend/js/frontend.js') }}"></script>
    <script src="{{ asset('frontend/js/slider.js') }}"></script>
</body>

</html>