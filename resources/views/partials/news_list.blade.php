<div class="row">
    @foreach($news as $newsItem)
        <div class="news-item col-md-6 col-sm-12 mb-4">
            <img src="{{ $newsItem->image }}" alt="Image" class="img-fluid">
            <div class="news-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></div>
            <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
        </div>
    @endforeach
</div>

