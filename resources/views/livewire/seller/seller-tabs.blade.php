<div class="row">

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a href="javascript:;"
                    onclick="event.preventDefault();document.getElementById('sellerProfilePictureFile').click();"
                    class="edit-avatar"><i class="fa fa-pencil"></i></a>
                <img src="{{ $seller->picture }}" alt="" class="avatar-photo" id="sellerProfilePicture">
                <input type="file" name="sellerProfilePictureFile" id="sellerProfilePictureFile" class="d-none"
                    style="opacity:0">
            </div>
            <h5 class="text-center h5 mb-0" id="sellerProfileName">{{ $seller->name }}</h5>
            <p class="text-center text-muted font-14" id="sellerProfileEmail">
                {{ $seller->email }}
            </p>

        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a wire:click.prevent='selectTab("personal_details")'
                                class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}" data-toggle="tab"
                                href="#personal_details" role="tab">Personal details</a>
                        </li>
                        <li class="nav-item">
                            <a wire:click.prevent='selectTab("update_password")'class="nav-link {{ $tab == 'update_password' ? 'active' : '' }}"
                                data-toggle="tab" href="#update_password" role="tab">Update password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Timeline Tab start -->
                        <div class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : '' }}"
                            id="personal_details" role="tabpanel">
                            <div class="pd-20">
                                <form wire:submit='updateSellerPersonalDetails()'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Full name</label>
                                                <input type="text" class="form-control" placeholder="Enter full name"
                                                    wire:model ='name'>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control" placeholder="Enter email"
                                                    wire:model ='email' disabled>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" class="form-control" placeholder="Enter userName"
                                                    wire:model ='userName'>
                                                @error('userName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter phone number" wire:model ='phone'>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control" placeholder="Enter address"
                                                    wire:model ='address'>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                        <!-- Timeline Tab End -->
                        <!-- Tasks Tab start -->
                        <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}"
                            id="update_password" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                <form wire:submit='updatePassword()'>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Current password</label>
                                                <input type="password" placeholder="Enter current password"
                                                    wire:model='current_password' class="form-control">
                                                @error('current_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">New password</label>
                                                <input type="password" placeholder="Enter new password"
                                                    wire:model='new_password' class="form-control">
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Confirm new password</label>
                                                <input type="password" placeholder="Retype new password"
                                                    wire:model='new_password_confirmation' class="form-control">
                                                @error('new_password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update password</button>
                                </form>
                            </div>
                        </div>
                        <!-- Tasks Tab End -->

                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
