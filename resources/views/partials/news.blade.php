<div class="news-container">
    <div class="header-news-container">
        <div class="left-header-news-container">Tin tức</div>
        <div class="right-header-news-container">
            <button id="prev-news">truoc</button>
            <button id="next-news">sau</button>
        </div>
    </div>
    <div class="middle-news-container" id="news-list">
        <div class="news-item">
            @foreach($news as $newsItem)
                <div class="news-item">
                    <img src="{{ $newsItem->image }}" alt="Tin tức">
                    <div class="news-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></div>
                    <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
                    <div class="justify">
                        {{ Str::limit($newsItem->content, 150) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        const showLimit = 4;
        let currentPage = 1;

        function renderNews(news, page) {
            $('#news-list').empty();
            const start = (page - 1) * showLimit;
            const end = start + showLimit;
            const paginatedNews = news.slice(start, end);

            paginatedNews.forEach(function(newsItem) {
                $('#news-list').append(`
                    <div class="news-item">
                        <img src="${newsItem.image}" alt="Tin tức">
                        <div class="news-title"><a href="/news/${newsItem.id}">${newsItem.title}</a></div>
                        <div class="posted-time">${new Date(newsItem.published_date).toLocaleDateString('vi-VN')}</div>
                        <div class="justify">
                            ${newsItem.content.substring(0, 150)}...
                        </div>
                    </div>
                `);
            });
        }

        function updateButtons(news) {
            const totalPages = Math.ceil(news.length / showLimit);
            $('#prev-news').prop('disabled', currentPage === 1);
            $('#next-news').prop('disabled', currentPage === totalPages);
        }

        $('#prev-news').click(function() {
            if (currentPage > 1) {
                currentPage--;
                renderNews(@json($news), currentPage);
                updateButtons(@json($news));
            }
        });

        $('#next-news').click(function() {
            const totalPages = Math.ceil(@json($news).length / showLimit);
            if (currentPage < totalPages) {
                currentPage++;
                renderNews(@json($news), currentPage);
                updateButtons(@json($news));
            }
        });

        renderNews(@json($news), currentPage);
        updateButtons(@json($news));
    });
</script>