@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/news_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/hot_products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/news.css') }}">
    <div class="header-content">
        @include('partials.sidebar')
        @include('partials.banner')
    </div>
    <div class="middle-content">
        <div class="left-middle-content">
            @include('partials.support')
            @include('partials.news_sidebar')
        </div>
        <div class="right-middle-content">
            @include('partials.hot_products')
            @include('partials.products')
        </div>
    </div>
    <div class="bottom-content">
        @include('partials.news')
    </div>
@endsection
