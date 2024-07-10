@extends('Back.layouts.auth-layouts.auth-master')
@section('title')
    Seller-forget-password
@endsection
@section('head-title')
    Forgot Password
@endsection
@section('content')
    <form action="{{ route('seller.send-password-rest-link') }}" method="POST">
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
            <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" value="{{ old('email') }}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
            </div>
        </div>
        @error('email')
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block" >Submit</button>
                </div>
            </div>
            <div class="col-2">
                <div class="font-16 weight-600 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">
                    OR
                </div>
            </div>
            <div class="col-5">
                <div class="input-group mb-0">
                    <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('seller.login') }}">Login</a>
                </div>
            </div>
        </div>
    </form>
@endsection
