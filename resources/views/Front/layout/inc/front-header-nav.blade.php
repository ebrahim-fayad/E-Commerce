<div class="container-fluid-lg">
    <div class="row">
        <div class="col-12">
            <div class="header-nav">
                <div class="header-nav-left">
                    <button class="dropdown-category">
                        <i class="ijaboIcon icon-copy bi bi-list-nested "></i>
                        <span>&nbsp;Browse Categories</span>
                    </button>

                    <div class="category-dropdown">
                        <div class="category-title">
                            <h5>Categories</h5>
                            <button type="button" class="btn p-0 close-button text-content">
                                <i class="fa fa-xmark"></i>
                            </button>
                        </div>

                        @if (count(categories()) > 0)

                            @foreach (categories() as $category)


                                <ul class="category-list">
                                    <li class="onhover-category-list">
                                        <a href="javascript:void(0)" class="category-name">
                                            <img src="/images/categories/{{ $category->category_image }}" alt>
                        <h6>{{ $category->category_name }}</h6>

                        @if (count($category->subcategories) > 0)
                        <i class="fa fa-angle-right"></i>
                        @endif

                        </a>

                        @if (count($category->subcategories) > 0)
                        <div class="onhover-category-box">
                            @foreach ($category->subcategories as $subcategory)
                            @if ($subcategory->is_child_of == 0)
                            <div class="list">
                                <div class="category-title-box">
                                    <a href="javascript:void(0)">
                                        <h5>{{ $subcategory->subcategory_name }}</h5>
                                    </a>

                                </div>
                                @if (count($subcategory->children) > 0)
                                <ul>
                                    @foreach ($subcategory->children as $child_subcategory)
                                    <li>
                                        <a href="javascript:void(0)">{{ $child_subcategory->subcategory_name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endif
                        </li>
                        </ul>
                        @endforeach

                        @endif
                    </div>
                </div>

                <div class="header-nav-middle">
                    <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                        <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                            <div class="offcanvas-header navbar-shadow">
                                <h5>Menu</h5>
                                <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav ijabo-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link nav-link-2" href="index.html">Home</a>
                                    </li>

                                    <li class="nav-item dropdown dropdown-mega">
                                        <a class="nav-link dropdown-toggle ps-xl-2 ps-0" href="javascript:void(0)"
                                            data-bs-toggle="dropdown">Shop</a>

                                        <div class="dropdown-menu dropdown-menu-2 row g-3">
                                            <div class="dropdown-column col-xl-4">
                                                <h5 class="dropdown-header"><a href="javascript:void(0)">Clothing</a>
                                                </h5>
                                                <a class="dropdown-item" href="javascript:void(0)">Vehicula,
                                                    Enim & Donec</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Tristique
                                                    &
                                                    Pulvinar</a>

                                                <a href="javascript:void(0)" class="dropdown-item">Lorem
                                                    Ipsum
                                                    Dolo</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Ridiculus
                                                    Scelerisque</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Primis
                                                    Sapien</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Habitant
                                                    Dignissim</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Nunc
                                                    in
                                                    Aliquam</a>
                                            </div>

                                            <div class="dropdown-column col-xl-4">
                                                <h5 class="dropdown-header"><a href="javascript:void(0)">Home
                                                        &
                                                        Garden
                                                    </a></h5>
                                                <a class="dropdown-item" href="javascript:void(0)">Quisque
                                                    &
                                                    Porta</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Fusce
                                                    Natoque</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Vehicula
                                                    Enim</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Rutrum
                                                    Neque</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Nascetur
                                                    Suspendisse</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Pharetra
                                                    Nascetur</a>

                                                <a href="javascript:void(0)" class="dropdown-item">Egestas
                                                    Bibendum</a>
                                            </div>

                                            <div class="dropdown-column col-xl-4">
                                                <h5 class="dropdown-header"><a href="javascript:void(0)">Beauty</a>
                                                </h5>
                                                <a class="dropdown-item" href="javascript:void(0)">Feugiat
                                                    Donec</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Blandit
                                                    Malesuada</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Convallis
                                                    Tristique</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Himenaeos
                                                    Cursus</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Accumsan
                                                    Dignissim</a>

                                                <a class="dropdown-item" href="javascript:void(0)">Pharetra
                                                    Nascetur</a>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                            data-bs-toggle="dropdown">Pages</a>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <a class="dropdown-item" href="about-us.html">About
                                                    Us</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="checkout.html">Checkout</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="compare.html">Compare</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="wishlist.html">Wishlist</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="cart.html">Cart</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="success.html">Order
                                                    Success</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="search.html">Search</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="user-dashboard.html">User
                                                    Dashboard</a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="forgot.html">Forgot
                                                    Password</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="404.html">404</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-2" href="blog.html">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-2" href="about-us.html">About
                                            Us</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav-link-2" href="contact-us.html">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
