$(document).ready(function(){
    const sidebarShowLimit = 1;
    let sidebarCurrentPage = 1;
    const news = window.newsData;

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
            renderSidebarNews(news, sidebarCurrentPage);
            updateSidebarButtons(news);
        }
    });

    $('#next-sidebar-news').click(function() {
        const totalPages = Math.ceil(news.length / sidebarShowLimit);
        if (sidebarCurrentPage < totalPages) {
            sidebarCurrentPage++;
            renderSidebarNews(news, sidebarCurrentPage);
            updateSidebarButtons(news);
        }
    });

    renderSidebarNews(news, sidebarCurrentPage);
    updateSidebarButtons(news);
});