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
    {{-- My Style Style link  --}}
    <link rel="stylesheet" href="../../css/index.css">

    {{-- Swiper js cdn link --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    {{-- font awosem cdn link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    @yield('style')
</head>

<body>

    {{-- navbar --}}
    <header>

        <a href="/" class="logo"><i class="fas fa-utensils"></i>BERINGIN BARU</a>

        <nav class="navbar">
            <a href="/" class="active">home</a>
            <a href="/#about">about</a>
            <a href="/#menu">menu</a>
            <a href="/#review">reviews</a>
            <a href="/#review2">Add review</a>
        </nav>
        @if (Auth()->guard()->check())
            {{-- Dakchi li4aytl3 ila kan user mconnecte --}}
            <div class="icons">
                <i class="fas fa-bars" id="menu-bars"></i>
                {{-- -<i class="fas fa-search" id="search-icon"></i> --}}
                <a href="{{ route('Jador.index') }}" class="fas fa-heart"></a>
                <a href="{{ route('cart.index') }}" class="fas fa-shopping-cart"></a>
                <a href="{{ route('user.profile', auth()->user()->id) }}" class="user" id="auth-icon">
                    @if (auth()->user()->image !== 'image')
                        <img src="{{ asset('images/profile/' . auth()->user()->image) }}" alt="userImage">
                    @else
                        <img src="images/profile/userImage.png" alt="userImage">
                    @endif
                </a>
            </div>
        @else
            {{-- Dakchi li4aytl3 ila kan user mamconnectich --}}
            <div class="icons">
                <i class="fas fa-bars" id="menu-bars"></i>
                <a href="/login" class="fas fa-user" id="auth-icon"></a>
                {{-- -<i class="fas fa-search" id="search-icon"></i> --}}
                <a href="#" class="fas fa-heart"></a>
                <a href="{{ route('cart.index') }}" class="fas fa-shopping-cart"></a>
            </div>
        @endif



    </header>

    {{-- ennd header navbar section --}}



    {{-- end shearch form --}}
    @yield('content')



    <!-- footer section start --->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Location</h3>
                <a href="#">Sumatera Utara</a>
            </div>
            <div class="box">
                <h3>Contact Info</h3>
                <a href="https://wa.me/+6282161691528">+62 821-6169-1528</a>
                <a href="#">Bayu</a>
            </div>
            <div class="box">
                <h3>follow us</h3>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
            </div>
        </div>
    </section>

    <!-- foter section end -->



    <!-- loader part -->
    <div class="loader-container">
        <img src="images/LoaderGifs/loading-scene.gif" alt="">
    </div>
    {{-- swiper js script --}}
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    {{-- my script file --}}
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>

    <!-- icons ankhdm b ionicons link dsite : https://ionic.io/ionicons/v4 -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    {{-- Sweetalert script cdn --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
