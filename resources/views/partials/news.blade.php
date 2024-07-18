<div class="news-container">
    <div class="header-news-container">
        <div class="left-header-news-container">Tin tức</div>
        <div class="right-header-news-container">
            <button id="prev-news">
                <img src="images/icon_left.svg" alt="Icon">
            </button>
            <button id="next-news">
                <img src="images/icon_right.svg" alt="Icon">
            </button>
        </div>
    </div>
    <div class="middle-news-container" id="news-list">
        <div class="news-item">
            @foreach($news as $newsItem)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="news-item">
                        <img src="{{ $newsItem->image }}" alt="Tin tức">
                        <div class="news-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></div>
                        <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
                        <div class="justify">
                            {{ Str::limit($newsItem->content, 150) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>window.newsData = @json($news);</script>
<script src="js/user/news_home.js"></script>