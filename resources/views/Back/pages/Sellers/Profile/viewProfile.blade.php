@extends('Back.layouts.pages-layouts.back-master',['title_page' => 'Profile'])
@section('title')Seller Profile Page @endsection
@section('profile-active')active @endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('seller.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
{{-- <div class="row"> --}}
    @livewire('seller.seller-tabs')
{{-- </div> --}}
@push('scripts')
    <script>
        $('input[type="file"][name="sellerProfilePictureFile"][id="sellerProfilePictureFile"]').Kropify({
         preview:'#sellerProfilePicture',
        viewMode:1,
        aspectRatio:1,
        cancelButtonText:'Cancel',
        resetButtonText:'Reset',
        cropButtonText:'Crop & update',
        processURL:'{{ route("seller.changeProfilePicture") }}',
        maxSize:2097152,
        showLoader:true,
        success:function(data){
            Livewire.dispatch('refresh');
            Swal.fire({
            position: "center",
            icon: "success",
            title: "Seller Picture  Updated Successfully",
            showConfirmButton: false,
            timer: 1500
        });
          },
          errors:function(error, text){
             console.log(text);
          },
        });
    </script>
@endpush
@endsection

