$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "/admin/manage/news?page=" + page,
            success: function(data) {
                $('#news-content').html(data.news);
                $('#pagination-content').html(data.pagination);
            }
        });
    }

    $('#addNewsForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            title: $('#title').val(),
            content: $('#content').val(),
            published_date: $('#published_date').val(),
            image: $('#image').val()
        };
    
        $.ajax({
            url: "/admin/manage/news",
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#addNewsModal').modal('hide');
                fetch_data(1); 
                alert('Tin tức đã được thêm thành công!');
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi thêm tin tức.');
            }
        });
    });            

    $(document).on('click', '.btn-edit', function() {
        var newsId = $(this).data('id');
        $.get("/admin/manage/news/" + newsId, function(data) {
            console.log("Fetched data:", data);
            $('#editNewsId').val(data.id);
            $('#edit_title').val(data.title);
            $('#edit_content').val(data.content);
            $('#edit_published_date').val(data.published_date);
            $('#edit_image').val(data.image);
            $('#editNewsModal').modal('show');
        });
    });

    $('#editNewsForm').on('submit', function(event) {
        event.preventDefault();

        var newsId = $('#editNewsId').val();
        var formData = {
            title: $('#edit_title').val(),
            content: $('#edit_content').val(),
            published_date: $('#edit_published_date').val(),
            image: $('#edit_image').val() 
        };

        $.ajax({
            url: "/admin/manage/news/" + newsId,
            method: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#editNewsModal').modal('hide');
                fetch_data(1);
                alert('Tin tức đã được cập nhật thành công!');
            },
            error: function(xhr) {
                console.error('Error updating news:', xhr);
                alert('Có lỗi xảy ra khi cập nhật tin tức.');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        if (confirm('Bạn có chắc chắn muốn xóa tin tức này không?')) {
            var newsId = $(this).data('id');
            $.ajax({
                url: "/admin/manage/news/" + newsId,
                method: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    fetch_data(1); 
                    alert('Tin tức đã được xóa thành công!');
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra khi xóa tin tức.');
                }
            });
        }
    });
});