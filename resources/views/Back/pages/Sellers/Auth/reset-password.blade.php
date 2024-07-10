@extends('Back.layouts.auth-layouts.auth-master')
@section('title')
    Seller-reset-password
@endsection
@section('head-title')
    Reset Password
@endsection
@section('content')
    <h6 class="mb-20">Enter your new password, confirm and submit</h6>
    <form action="{{ route('seller.resetPasswordHandler', ['token'=>$token]) }}" method="post">
        @csrf
                @session('success')
            <div class="alert alert-success">
                {{ Session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endsession
        @session('fail')
            <div class="alert alert-danger">
                {{ Session('fail') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endsession
        <div class="input-group custom">
            <input type="text" name="new_password" class="form-control form-control-lg" placeholder="New Password">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password')
        <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message }}
            </div>
        @enderror
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Confirm New Password" name="new_password_confirmation">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('new_password_confirmation')
        <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message }}
            </div>
        @enderror
        <div class="row align-items-center">
            <div class="col-5">
                <div class="input-group mb-0">
                    <!--
               use code for form submit
               <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
              -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
