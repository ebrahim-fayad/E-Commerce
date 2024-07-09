<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    @include('Back.layouts.auth-layouts.auth-head')
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="{{ general_setting()->logo }}" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    @if (!Route::is('admin/*'))
                    @if (Route::is('saller.*'))
                    <li><a href="register.html">Register</a></li>
                    @endif
                    {{-- <li><a href="register.html">Register</a></li> --}}
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/back/vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">@yield('head-title')</h2>
                        </div>
                        <!-- content -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer scripts -->
    @include('Back.layouts.auth-layouts.auth-scripts')
</body>

</html>
