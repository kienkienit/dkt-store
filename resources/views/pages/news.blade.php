@extends('layouts.master')
@section('title', 'News')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/news.css') }}">
    <div class="go-home">
        <a href="/">Trang chủ</a>
        <span>>></span>
        <p>Tin tức</p>
    </div>
    <div class="news-container">
        <div class="news-list-title">Tin tức</div>
        <div class="line"></div>
        <div class="news-list" id="news-content">
            @include('partials.news_list', ['news' => $news])
        </div>
        <div id="pagination-content">
            @include('partials.pagination', ['pagination' => $pagination])
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/user/news.js') }}"></script>
@endsection