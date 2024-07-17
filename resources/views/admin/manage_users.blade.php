@extends('layouts.admin')
@section('title', 'Quản Lý Tài Khoản')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/manage_users.css') }}">
    @include('partials-admin.sidebar')
    <div class="main-content">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Danh Sách Tài Khoản</h2>
                <button class="btn btn-success btn-add-user" data-toggle="modal" data-target="#addUserModal">Thêm Tài Khoản</button>
            </div>
            <div id="users-content">
                @include('partials-admin.users', ['users' => $users])
            </div>
        </div>
    </div>

    <!-- Modals thêm và sửa tài khoản -->
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Thêm Tài Khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh Sửa Tài Khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId">
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="edit_role">Role</label>
                            <select class="form-control" id="edit_role" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
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
                    url: "{{ route('admin.manage.users') }}?page=" + page,
                    success: function(data) {
                        $('#users-content').html(data.users);
                    }
                });
            }

            $('#addUserForm').on('submit', function(event) {
                event.preventDefault();

                var formData = {
                    username: $('#username').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role: $('#role').val()
                };
            
                $.ajax({
                    url: "{{ route('admin.manage.users.create') }}",
                    method: "POST",
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#addUserModal').modal('hide');
                        fetch_data(1); 
                        alert('Tài khoản đã được thêm thành công!');
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi thêm tài khoản.');
                    }
                });
            });            

            $(document).on('click', '.btn-edit', function() {
                var userId = $(this).data('id');
                $.get("/admin/manage/users/" + userId, function(data) {
                    $('#editUserId').val(data.id);
                    $('#edit_username').val(data.username);
                    $('#edit_email').val(data.email);
                    $('#edit_role').val(data.role);
                    $('#editUserModal').modal('show');
                });
            });

            $('#editUserForm').on('submit', function(event) {
                event.preventDefault();
        
                var userId = $('#editUserId').val();
                var formData = {
                    username: $('#edit_username').val(),
                    email: $('#edit_email').val(),
                    password: $('#edit_password').val(),
                    role: $('#edit_role').val() 
                };
        
                $.ajax({
                    url: "/admin/manage/users/" + userId,
                    method: "POST",
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#editUserModal').modal('hide');
                        fetch_data(1);
                        alert('Tài khoản đã được cập nhật thành công!');
                    },
                    error: function(xhr) {
                        console.error('Error updating user:', xhr);
                        alert('Có lỗi xảy ra khi cập nhật tài khoản.');
                    }
                });
            });

            $(document).on('click', '.btn-delete', function() {
                if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
                    var userId = $(this).data('id');
                    $.ajax({
                        url: "/admin/manage/users/" + userId,
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            fetch_data(1); 
                            alert('Tài khoản đã được xóa thành công!');
                        },
                        error: function(xhr) {
                            alert('Có lỗi xảy ra khi xóa tài khoản.');
                        }
                    });
                }
            });
        });
    </script>
@endsection