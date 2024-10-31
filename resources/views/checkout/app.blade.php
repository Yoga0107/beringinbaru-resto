<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Resto') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/logos/logosite.png') }}">
    {{-- style bootstrap --}}
    <link rel="stylesheet" href="../../css/Bootstrap5.css">
    {{-- My Style Style link  --}}
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/custom.css">

    {{-- Swiper js cdn link --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    {{-- font awosem cdn link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    @yield('style')
</head>

<body>

    {{-- START CONTENT --}}
    @yield('content')
    {{-- END CONTENT --}}

    <!-- loader part -->
    {{-- // NOTE: Uncomment if production --}}
    {{-- <div class="loader-container">
        <img src="images/LoaderGifs/loading-scene.gif" alt="">
    </div> --}}
    {{-- swiper js script --}}
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    {{-- my script file --}}
    <script src="{{ asset('js/loader.js') }}"></script>

    <!-- icons ankhdm b ionicons link dsite : https://ionic.io/ionicons/v4 -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    {{-- Sweetalert script cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
