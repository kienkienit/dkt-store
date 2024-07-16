<div class="news-sidebar">
    <div class="header-news-sidebar">
        <div class="left-header-news-sidebar">Tin tức</div>
        <div class="right-header-news-sidebar">
            <button id="prev-sidebar-news">
                <img src="images/icon_left.svg" alt="Icon">
            </button>
            <button id="next-sidebar-news">
                <img src="images/icon_right.svg" alt="Icon">
            </button>
        </div>
    </div>
    <div class="middle-news-sidebar" id="news-sidebar-content">
        @foreach($news as $newsItem)
            <img src="{{ $newsItem->image }}" alt="Tin tức">
            <div class="news-title"><a href="{{ route('news.show', $newsItem->id) }}">{{ $newsItem->title }}</a></div>
            <div class="posted-time">{{ \Carbon\Carbon::parse($newsItem->published_date)->format('d/m/Y') }}</div>
            <div class="justify">
                {{ Str::limit($newsItem->content, 150) }}
            </div>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        const sidebarShowLimit = 1;
        let sidebarCurrentPage = 1;

        function renderSidebarNews(news, page) {
            $('#news-sidebar-content').empty();
            const start = (page - 1) * sidebarShowLimit;
            const end = start + sidebarShowLimit;
            const paginatedNews = news.slice(start, end);

            paginatedNews.forEach(function(newsItem) {
                $('#news-sidebar-content').append(`
                    <img src="${newsItem.image}" alt="Tin tức">
                    <div class="news-title"><a href="/news/${newsItem.id}">${newsItem.title}</a></div>
                    <div class="posted-time">${new Date(newsItem.published_date).toLocaleDateString('vi-VN')}</div>
                    <div class="justify">
                        ${newsItem.content.substring(0, 150)}...
                    </div>
                `);
            });
        }

        function updateSidebarButtons(news) {
            const totalPages = Math.ceil(news.length / sidebarShowLimit);
            $('#prev-sidebar-news').prop('disabled', sidebarCurrentPage === 1);
            $('#next-sidebar-news').prop('disabled', sidebarCurrentPage === totalPages);
        }

        $('#prev-sidebar-news').click(function() {
            if (sidebarCurrentPage > 1) {
                sidebarCurrentPage--;
                renderSidebarNews(@json($news), sidebarCurrentPage);
                updateSidebarButtons(@json($news));
            }
        });

        $('#next-sidebar-news').click(function() {
            const totalPages = Math.ceil(@json($news).length / sidebarShowLimit);
            if (sidebarCurrentPage < totalPages) {
                sidebarCurrentPage++;
                renderSidebarNews(@json($news), sidebarCurrentPage);
                updateSidebarButtons(@json($news));
            }
        });

        renderSidebarNews(@json($news), sidebarCurrentPage);
        updateSidebarButtons(@json($news));
    });
</script>