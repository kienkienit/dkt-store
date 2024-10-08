@extends('layouts.admin')
@section('title', 'Quản Lý Tin Tức')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_news.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div class="top-content ml-3">
                <h2>Danh Sách Tin Tức</h2>
                <button class="btn btn-success btn-add-news" data-toggle="modal" data-target="#addNewsModal">Thêm Tin Tức</button>
            </div>
            <div id="news-content">
                @include('partials-admin.news', ['news' => $news])
            </div>
            <div id="pagination-content">
                @include('partials-admin.pagination', ['pagination' => $pagination])
            </div>
        </div>
    </div>

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
                            <label for="title">Tiêu Đề <span>*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội Dung <span>*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="published_date">Ngày Đăng Tin <span>*</span></label>
                            <input type="date" class="form-control" id="published_date" name="published_date" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Đường dẫn ảnh <span>*</span></label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('js/admin/manage_news.js') }}"></script>
@endsection