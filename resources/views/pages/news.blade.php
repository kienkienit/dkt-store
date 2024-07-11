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
        <div class="news-list">
            @foreach($news as $newsItem)
                <div class="news-item">
                    <img src="{{ $newsItem->image }}" alt="Image">
                    <div class="news-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></div>
                    <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            @if ($news->onFirstPage())
                <button class="page-item disabled" disabled>&laquo; Previous</button>
            @else
                <a href="{{ $news->previousPageUrl() }}" class="page-item">&laquo; Previous</a>
            @endif

            @if ($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" class="page-item">Next &raquo;</a>
            @else
                <button class="page-item disabled" disabled>Next &raquo;</button>
            @endif
        </div>
    </div>
@endsection