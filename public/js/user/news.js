$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "/news?page=" + page,
            success: function(data) {
                $('#news-content').html(data.news);
                $('#pagination-content').html(data.pagination);
            },
            error: function(error) {
                console.error('Error loading news:', error);
            }
        });
    }
});