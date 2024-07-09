@extends('Back.layouts.auth-layouts.auth-master')
@section('title') Admin-login-page @endsection
@section('head-title') Admin Login @endsection
@section('content')
    <form accept="{{ route('admin.login') }}" method="POST">
        @csrf
        @if (session('retry_after'))
            <div id="retry-message">
                يمكنك تسجيل الدخول مرة أخرى بعد <span id="retry-timer">{{ session('retry_after') }}</span> ثانية.
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var retryAfter = {{ session('retry_after') }};
                    var retryTimerElement = document.getElementById('retry-timer');
                    var interval = setInterval(function() {
                        retryAfter--;
                        retryTimerElement.textContent = retryAfter;
                        if (retryAfter <= 0) {
                            clearInterval(interval);
                            document.getElementById('retry-message').className = "alert alert-success";
                            document.getElementById('retry-message').textContent =
                                'يمكنك الآن محاولة تسجيل الدخول مرة أخرى.';
                        }
                    }, 1000);
                });
            </script>
        @endif

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
            <input type="text" class="form-control form-control-lg" name="login_id" placeholder="Email / Username"
                value="{{ old('login_id') }}" />
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        @error('login_id')
            <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message }}
            </div>
        @enderror
        <div class="input-group custom">
            <input name="password" type="password" class="form-control form-control-lg" placeholder="**********" />
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>
        @error('password')
            <div class="d-block text-danger" style="margin-top: -25px;margin-bottom: 15px">
                {{ $message }}
            </div>
        @enderror
        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="customCheck1" />
                    <label class="custom-control-label" for="customCheck1">Remember</label>
                </div>
            </div>
            <div class="col-6">
                <div class="forgot-password">
                    <a href="{{ route('admin.forget-admin-password') }}">Forgot Password</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign In">
                </div>


            </div>
        </div>
    </form>
@endsection
