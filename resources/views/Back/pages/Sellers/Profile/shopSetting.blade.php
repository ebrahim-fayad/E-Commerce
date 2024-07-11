@extends('Back.layouts.pages-layouts.back-master',['title_page' => 'shopSetting'])
@section('title')Seller shopSetting Page @endsection
@section('shop-active')active @endsection
@section('content')
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    {{-- <x-alert.form-alert/> --}}
        @if ( Session::get('success') )
    <div class="alert alert-success">
        {{ Session::get('success') }}
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
   @endif
    <form action="{{ route('seller.shop-setup') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for=""><b>Shop name:</b></label>
                <input type="text" class="form-control" name="shop_name" placeholder="Enter your shop name here..." value="{{ old('shop_name') ? old('shop_name') : $shopInfo->shop_name }}">
                @error('shop_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for=""><b>Shop phone:</b></label>
                <input type="text" class="form-control" name="shop_phone" placeholder="eg: +1 234 567 890" value="{{ old('shop_phone') ? old('shop_phone') : $shopInfo->shop_phone }}">
                @error('shop_phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for=""><b>Shop address:</b></label>
                <input type="text" class="form-control" name="shop_address" placeholder="eg: 8977 HUXS Street 56" value="{{ old('shop_address') ? old('shop_address') : $shopInfo->shop_address }}">
                @error('shop_address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for=""><b>Shop description:</b></label>
                <textarea class="form-control" name="shop_description" cols="30" rows="10" placeholder="Describe your shop...">{{ old('shop_description') ? old('shop_description') : $shopInfo->shop_description }}</textarea>
                @error('shop_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for=""><b>Shop logo:</b></label>
                <input type="file" name="shop_logo" class="form-control">
                <div class="mb-2 mt-1" style="max-width: 200px">
                    <img src="{{ $shopInfo->shop_logo != null ? '/images/shop/'.$shopInfo->shop_logo : '' }}" alt="" class="img-thumbnail" id="shop_logo_preview">
                </div>
                @error('shop_logo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
    </form>
</div>

@endsection
@push('scripts')
    <script>
        document.querySelector('input[type="file"][name="shop_logo"]').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#shop_logo_preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endpush
