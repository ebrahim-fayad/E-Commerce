<div class="tab">
    <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'general_settings' ? 'show active' : '' }}"
                wire:click.prevent = 'selectTab("general_settings")' data-toggle="tab" href="#general_settings"
                role="tab" aria-selected="true"> General Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'logo_favicon' ? 'show active' : '' }}" data-toggle="tab"
                wire:click.prevent = 'selectTab("logo_favicon")' href="#logo_favicon" role="tab"
                aria-selected="false">Logo & Favicon</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'social_network' ? 'show active' : '' }}" data-toggle="tab"
                wire:click.prevent = 'selectTab("social_network")' href="#social_network" role="tab"
                aria-selected="false">Social Network</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'payment_method' ? 'show active' : '' }}" data-toggle="tab"
                wire:click.prevent = 'selectTab("payment_method")' href="#payment_method" role="tab"
                aria-selected="false">Payment Method</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade {{ $tab == 'general_settings' ? 'show active' : '' }}" id="general_settings"
            role="tabpanel">
            <div class="pd-20">
                <form wire:submit='updateGeneralSettings()'>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site name</b></label>
                                <input type="text" class="form-control" placeholder="Enter site name"
                                    wire:model='site_name'>
                                @error('site_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site email</b></label>
                                <input type="text" class="form-control" placeholder="Enter site email"
                                    wire:model='site_email'>
                                @error('site_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site phone</b></label>
                                <input type="text" class="form-control" placeholder="Enter site phone"
                                    wire:model='site_phone'>
                                @error('site_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Site meta keywords</b><small> Separated by comma
                                        (a,b,c)</small></label>
                                <input type="text" class="form-control" placeholder="Enter site meta keywords"
                                    wire:model='site_meta_keywords'>
                                @error('site_meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Site Address</label>
                        <input type="text" class="form-control" placeholder="Enter site address"
                            wire:model="site_address">
                        @error('site_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Site meta description</label>
                        <textarea cols="4" rows="4" placeholder="Site meta desc...." class="form-control"
                            wire:model='site_meta_description'></textarea>
                        @error('site_meta_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>

        <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'show active' : '' }}" id="logo_favicon" role="tabpanel">
            <div class="pd-20">
                <div class="row">
                    <div class="col-md-6">
                         <h5 class="mb-2 ">choose favicon foe your site</h5>
                        <form method="POST" wire:submit.prevent='uploadLogo()' enctype="multipart/form-data"
                            id="change_site_logo_form">
                            @csrf
                            <div class="mb-2">
                                <input type="file" wire:model='logo' id="site_logo" class="form-control">
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger error-text site_logo_error"></span>
                            </div>
                            <button wire:loading.class='disabled' type="submit" class="btn btn-primary">Change
                                logo</button>
                        </form>
                        @if ($logo)
                            <div class="col-md-6">
                                <h5>Site favicon</h5>
                                <div class="mb-2 mt-1" style="max-width: 300px;">
                                    <img src="{{ $logo->temporaryUrl() }}" alt="" class="img-thumbnail">
                                </div>

                            </div>
                        @endif
                    </div><!-- end logo -->
                    <div class="col-md-6">
                        <h5 class="mb-2 ">choose favicon foe your site</h5>
                        <form method="POST" wire:submit.prevent='uploadFavicon()' enctype="multipart/form-data"
                            id="change_site_favicon_form">
                            @csrf
                            <div class="mb-2">
                                <input type="file" wire:model='favicon' id="site_favicon" class="form-control">
                                @error('favicon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <button wire:loading.class='disabled' type="submit" class="btn btn-primary">Change
                                favicon</button>
                        </form>
                        @if ($favicon)
                            <div class="col-md-6">
                                <h5>Site favicon</h5>
                                <div class="mb-2 mt-1" style="max-width: 300px;">
                                    <img src="{{ $favicon->temporaryUrl() }}" alt="" class="img-thumbnail">
                                </div>

                            </div>
                        @endif
                    </div><!-- end favicon -->

                </div><!-- end pd-20 -->

            </div>
        </div><!-- end logo tab -->


        <div class="tab-pane fade {{ $tab == 'social_network' ? 'show active' : '' }}" id="social_network"
            role="tabpanel">
            <div class="pd-20">
             @livewire('admin.social.social-setting')
            </div>
        </div>
        <div class="tab-pane fade {{ $tab == 'payment_method' ? 'show active' : '' }}" id="payment_method"
            role="tabpanel">
            <div class="pd-20">
                -----Payment Method-----
            </div>
        </div>
    </div>
</div>
