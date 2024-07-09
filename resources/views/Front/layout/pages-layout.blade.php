
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fayad">
    <meta name="keywords" content="Fayad">
    <meta name="author" content="Fayad">
   @include('Front.layout.inc.front-head')

    @stack('stylesheets')
</head>

<body class="bg-effect">

    <!-- Header Start -->
    @include('front.layout.inc.header')
    <!-- Header End -->

    <!-- mobile menu start -->
    @include('front.layout.inc.mobile-menu')
    <!-- mobile menu end -->

    @yield('content')

    <!-- Footer Section Start -->
    @include('Front.layout.inc.front-footer')
    <!-- Footer Section End -->



    <!-- Tap to top start -->
    <div class="theme-option">
        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    @include('Front.layout.inc.front-footer-scripts')

</body>

</html>
