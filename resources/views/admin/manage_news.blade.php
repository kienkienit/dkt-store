@extends('layouts.admin')
@section('title', 'Quản Lý Tin Tức')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_news.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Danh Sách Tin Tức</h2>
                <button class="btn btn-success btn-add-news" data-toggle="modal" data-target="#addNewsModal">Thêm Tin Tức</button>
            </div>
            <div id="news-content">
                @include('partials-admin.news', ['news' => $news])
            </div>
        </div>
    </div>

    <!-- Modals thêm và sửa tin tức -->
    <!-- Add News Modal -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Thêm Tin Tức</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addNewsForm">
                        <div class="form-group">
                            <label for="title">Tiêu Đề</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội Dung</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="published_date">Ngày Đăng Tin</label>
                            <input type="date" class="form-control" id="published_date" name="published_date" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Đường dẫn ảnh</label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit News Modal -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Chỉnh Sửa Tin Tức</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editNewsForm">
                        <input type="hidden" id="editNewsId">
                        <div class="form-group">
                            <label for="edit_title">Tiêu Đề</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_content">Nội Dung</label>
                            <textarea class="form-control" id="edit_content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_published_date">Ngày Đăng Tin</label>
                            <input type="date" class="form-control" id="edit_published_date" name="published_date" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Link Ảnh</label>
                            <input type="text" class="form-control" id="edit_image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "{{ route('admin.manage.news') }}?page=" + page,
                    success: function(data) {
                        $('#news-content').html(data.news);
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
                    url: "{{ route('admin.manage.news.create') }}",
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
                            _token: '{{ csrf_token() }}'
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
    </script>
@endsection