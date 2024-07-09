@extends('layouts.master')
@section('title', 'News detail')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/pages/news_detail.css') }}">
    <div class="go-home">
        <a href="#">Trang chủ</a>
        <span>>></span>
        <a href="#">Tin tức</a>
        <span>>></span>
        <p>Mua iPhone 6s và iPhone 6s Plus chính hãng ở đâu?</p>
    </div>
    <div class="news-container">
        <img class="news-image" src="https://bizweb.dktcdn.net/100/047/633/articles/ip6s.png?v=1469340252480" alt="Image">
        <div class="news-title">Mua iPhone 6s và iPhone 6s Plus chính hãng ở đâu?</div>
        <div class="posted-time">11/01/2016</div>
        <div class="news-content">
            Không ai có thể phủ nhận sức hút từ vẻ đẹp của những chiếc điện thoại của hãng Apple. 
            Đặc biệt hơn, khi mà ở thời điểm hiện tại, giá iPhone 6s và iPhone 6s Plus đang giảm và dần dần trở nên vừa vặn với túi tiền của nhiều người hơn thì nhu cầu mua chiếc điện thoại này chắc chắn sẽ tăng cao. 
            Nếu bạn đang băn khoăn nên mua iPhone 6s chính hãng ở đâu? 
            Bài viết này sẽ giúp bạn hiểu và giải quyết câu hỏi đó cho bạn.
        </div>
    </div>
@endsection