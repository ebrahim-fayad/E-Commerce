@extends('Back.layouts.pages-layouts.back-master', ['title_page' => 'Seller All Products'])
@section('title')
    Seller All Products
@endsection
@section('product')

   @livewire('seller.product-list')
@endsection
