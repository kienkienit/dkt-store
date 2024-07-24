$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).data('page');
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "/admin/manage/users?page=" + page,
            success: function(data) {
                $('#users-content').html(data.users);
                $('#pagination-content').html(data.pagination);
            }
        });
    }

    $('#addUserForm').on('submit', function(event) {
        event.preventDefault();

        var formData = {
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            role: 'user'
        };
    
        $.ajax({
            url: "/admin/manage/users",
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
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    fetch_data(1); 
                    alert('Tài khoản đã được xóa thành công!');
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        alert(xhr.responseJSON.error);
                    } else {
                        alert('Có lỗi xảy ra khi xóa tài khoản.');
                    }
                }
            });
        }
    });
});