@extends('layouts.master')
@section('title', 'News detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/news_detail.css') }}">
    <div class="go-home">
        <a href="/">Trang chủ</a>
        <span>>></span>
        <a href="/news">Tin tức</a>
        <span>>></span>
        <p>Mua iPhone 6s và iPhone 6s Plus chính hãng ở đâu?</p>
    </div>
    <div class="news-container">
        <img class="news-image" src="{{ $newsItem->image }}" alt="Image">
        <div class="news-title">{{ $newsItem->title }}</div>
        <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
        <div class="news-content">
            {{ $newsItem->content }}
        </div>
    </div>
@endsection