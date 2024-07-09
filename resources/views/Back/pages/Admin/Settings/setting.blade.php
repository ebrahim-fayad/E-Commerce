@extends('Back.layouts.pages-layouts.back-master', ['title_page' => 'Settings'])
@section('title')
    Admin Settings Page
@endsection
@section('setting-active')
    active
@endsection
@section('content')
    <div class="pd-20 card-box">

        @livewire('admin.settings.settings-tabs')
    </div>
@endsection
