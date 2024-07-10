<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.html">
					<img src="{{ general_setting()->logo }}" alt="" class="dark-logo" />
					<img
						src="/back/vendors/images/deskapp-logo-white.svg"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
                    @if (auth()->guard('admin')->check())
                    <ul id="accordion-menu">

						<li>
							<a href="{{ route('admin.home') }}" class="dropdown-toggle no-arrow @yield('home-active')">
								<span class="micon fa fa-home"></span
								><span class="mtext">Home</span>
							</a>
						</li>
                        <li>
							<a href="{{ route('admin.categories.index') }}" class="dropdown-toggle no-arrow @yield('categories-active')">
								<span class="micon dw dw-align-left3"></span
								><span class="mtext">Manage Categories</span>
							</a>
						</li>
						<li>
							<a href="invoice.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Invoice</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Settings</div>
						</li>

						<li>
							<a
								href="{{ route('admin.profile') }}"
								class="dropdown-toggle no-arrow @yield('profile-active')"
							>
								<span class="micon fa fa-user"></span>
								<span class="mtext"
									>Profile
								</span>
							</a>
						</li>
						<li>
							<a
								href="{{ route('admin.settings') }}"
								class="dropdown-toggle no-arrow @yield('setting-active')"
							>
								<span class="micon icon-copy fi-widget"></span>
								<span class="mtext"
									>Settings
								</span>
							</a>
						</li>
					</ul>
                    @else
                    <ul id="accordion-menu">

						<li>
							<a href="{{ route('seller.home') }}" class="dropdown-toggle no-arrow @yield('home-active')">
								<span class="micon fa fa-home"></span
								><span class="mtext">Home</span>
							</a>
						</li>
						<li>
							<a href="invoice.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Invoice</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Settings</div>
						</li>

						<li>
							<a
								href="{{ route('seller.profile') }}"
								class="dropdown-toggle no-arrow @yield('profile-active')"
							>
								<span class="micon fa fa-user"></span>
								<span class="mtext"
									>Profile
								</span>
							</a>
						</li>

					</ul>
                    @endif

				</div>
			</div>
		</div>
