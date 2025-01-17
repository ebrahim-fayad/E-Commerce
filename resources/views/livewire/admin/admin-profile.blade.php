				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="{{ auth()->user()->picture }}" alt="" />
							</span>
							<span class="user-name">{{ auth()->user()->name }}</span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
                        @if (auth()->guard('admin')->check())
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"
                            ><i class="dw dw-user1"></i> Profile</a
                        >
                        @else
                        <a class="dropdown-item" href="{{ route('seller.profile') }}"
                            ><i class="dw dw-user1"></i> Profile</a
                        >

                        @endif
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-settings2"></i> Setting</a
							>
							<a class="dropdown-item" href="faq.html"
								><i class="dw dw-help"></i> Help</a
							>
							<a class="dropdown-item" href="#!" onclick="event.preventDefault();document.getElementById('logoutform').submit();"
								><i class="dw dw-logout"></i> Log Out</a
							>
                            @if (auth()->guard('admin')->check())
                            <form action="{{ route('admin.logout') }}" method="post" id="logoutform">@csrf</form>
                            @else
                            <form action="{{ route('seller.logout') }}" method="post" id="logoutform">@csrf</form>
                            @endif
						</div>
					</div>
				</div>
