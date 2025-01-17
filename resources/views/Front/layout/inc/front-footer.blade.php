<footer class="section-t-space">
    <div class="container-fluid-lg">
        <div class="main-footer section-b-space section-t-space">
            <div class="row g-md-4 g-3">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-logo">
                        <div class="theme-logo">
                            <a href="/">
                                <img src="{{ general_setting()->logo }}" class="blur-up lazyload" alt>
                            </a>
                        </div>

                        <div class="footer-logo-contain">
                            <p>{{ general_setting()->site_meta_description }}</p>

                            <ul class="address">
                                <li>
                                    <i data-feather="home"></i>
                                    <a href="http://maps.google.com/maps?q=<?= urlencode(general_setting()->site_address) ?>" target="_blank">{{ general_setting()->site_address }}</a>
                                </li>
                                <li>
                                    <i data-feather="mail"></i>
                                    <a href="mailto:{{ general_setting()->site_email }}">{{ general_setting()->site_email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Categories</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Home
                                    Entertainment</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Womens
                                    Fashion</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Mens
                                    Fashion</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Kids
                                    Fashion</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Office
                                    Equipment</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Video Games</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl col-lg-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Quick Links</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="shop.html" class="text-content">Shop</a>
                            </li>
                            <li>
                                <a href="about-us.html" class="text-content">About Us</a>
                            </li>
                            <li>
                                <a href="blog.html" class="text-content">Blog</a>
                            </li>
                            <li>
                                <a href="contact-us.html" class="text-content">Contact Us</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Privacy
                                    Policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Our sitemap</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-2 col-sm-3">
                    <div class="footer-title">
                        <h4>Help Center</h4>
                    </div>

                    <div class="footer-contain">
                        <ul>
                            <li>
                                <a href="success.html" class="text-content">Your Order</a>
                            </li>
                            <li>
                                <a href="user-dashboard.html" class="text-content">Your
                                    Account</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">Track Order</a>
                            </li>
                            <li>
                                <a href="wishlist.html" class="text-content">Your
                                    Wishlist</a>
                            </li>
                            <li>
                                <a href="search.html" class="text-content">Search</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="text-content">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h4>Contact Us</h4>
                    </div>

                    <div class="footer-contact">
                        <p>Do you have any questions or suggestions?</p>
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <i data-feather="phone"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Hotline
                                            24/7 :</h6>
                                        <h5>{{ general_setting()->site_phone }}</h5>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="footer-number">
                                    <i data-feather="mail"></i>
                                    <div class="contact-number">
                                        <h6 class="text-content">Email
                                            Address :</h6>
                                        <h5>{{ general_setting()->site_email }}</h5>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-footer section-small-space">
            <div class="reserve">
                <h6 class="text-content">&copy; Copyright
                    <script>document.write(new Date().getFullYear());</script>
                    Fayad. All rights reserved
                </h6>
            </div>

            <div class="payment">
                <img src="/front/images/payments.png" class="blur-up lazyload" alt>
            </div>

            <div class="social-link">
                <h6 class="text-content">Stay connected :</h6>
                <ul>
                    <li>
                        <a href="{{ social_network()->facebook_url }}" target="_blank">
                            <i class="ijaboIcon icon-copy bi bi-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ social_network()->twitter_url }}" target="_blank">
                            <i class="ijaboIcon icon-copy bi bi-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ social_network()->instagram_url }}" target="_blank">
                            <i class="ijaboIcon icon-copy bi bi-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ social_network()->youtube_url }}" target="_blank">
                            <i class="ijaboIcon icon-copy bi bi-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
