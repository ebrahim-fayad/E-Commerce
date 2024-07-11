@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
@endphp
<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('Back.layouts.pages-layouts.head')
</head>

<body>
    <!-- loader -->
    {{-- @include('Back.layouts.pages-layouts.loader') --}}

    <!-- header -->
    @include('Back.layouts.pages-layouts.header')

    <!-- right side-bar -->
    @include('Back.layouts.pages-layouts.right-bar')

    <!-- left -side-bar -->
    @include('Back.layouts.pages-layouts.left-bar')
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">

                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $title_page }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            @if (Route::is('seller.product.all-products'))
                            <a href="{{ route('seller.product.add-product') }}"><button class="btn btn-primary">Add New Product</button></a>
                            @else
                                <div class="dropdown">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown">
                                        {{ $currentDate->format('F') }} {{ $currentDate->format('Y') }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Export List</a>
                                        <a class="dropdown-item" href="#">Policies</a>
                                        <a class="dropdown-item" href="#">View Assets</a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                 @if (Route::is('seller.product.all-products'))
  @yield('product')
                @else
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    @yield('content')
                </div>
                @endif
            </div>

            <!-- footer -->
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By &copy; {{ Date('Y') }}
                <a href="https://github.com/ebrahim-fayad" target="_blank">Fayad</a>
            </div>
        </div>
    </div><!-- end container -->

    <!-- scripts -->
    @include('Back.layouts.pages-layouts.footer-scripts')
</body>

</html>
