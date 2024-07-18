$(document).ready(function(){
    const showLimitLarge = 4;
    const showLimitMedium = 3;
    const showLimitSmall = 2;
    let currentPage = 1;
    const news = window.newsData;

    function getShowLimit() {
        const width = $(window).width();
        if (width >= 992) { 
            return showLimitLarge;
        } else if (width >= 768) { 
            return showLimitMedium;
        } else {
            return showLimitSmall;
        }
    }

    function renderNews(news, page) {
        $('#news-list').empty();
        const showLimit = getShowLimit();
        const start = (page - 1) * showLimit;
        const end = start + showLimit;
        const paginatedNews = news.slice(start, end);

        paginatedNews.forEach(function(newsItem) {
            $('#news-list').append(`
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="news-item">
                        <img src="${newsItem.image}" alt="Tin tức">
                        <div class="news-title"><a href="/news/${newsItem.id}">${newsItem.title}</a></div>
                        <div class="posted-time">${new Date(newsItem.published_date).toLocaleDateString('vi-VN')}</div>
                        <div class="justify">
                            ${newsItem.content.substring(0, 150)}...
                        </div>
                    </div>
                </div>
            `);
        });
    }

    function updateButtons(news) {
        const showLimit = getShowLimit();
        const totalPages = Math.ceil(news.length / showLimit);
        $('#prev-news').prop('disabled', currentPage === 1);
        $('#next-news').prop('disabled', currentPage === totalPages);
    }

    $('#prev-news').click(function() {
        if (currentPage > 1) {
            currentPage--;
            renderNews(news, currentPage);
            updateButtons(news);
        }
    });

    $('#next-news').click(function() {
        const showLimit = getShowLimit();
        const totalPages = Math.ceil(news.length / showLimit);
        if (currentPage < totalPages) {
            currentPage++;
            renderNews(news, currentPage);
            updateButtons(news);
        }
    });

    $(window).resize(function() {
        renderNews(news, currentPage);
        updateButtons(news);
    });

    renderNews(news, currentPage);
    updateButtons(news);
});
