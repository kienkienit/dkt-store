<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->paginateUsers($request->input('page', 1), 5);
        if ($request->ajax()) {
            return response()->json([
                'users' => view('partials-admin.users', compact('users'))->render()
            ]);
        }

        return view('admin.manage_users', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|string|in:user,admin'
            ]);

            $data = $request->all();
            $this->userService->createUser($data);

            return response()->json(['success' => 'Tài khoản đã được thêm thành công!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra khi thêm tài khoản.'], 500);
        }
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string'
        ]);

        $this->userService->updateUser($id, $data);

        return response()->json(['success' => 'Tài khoản đã được cập nhật thành công!']);
    }

    public function delete($id)
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['success' => 'Tài khoản đã được xóa thành công!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra khi xóa tài khoản.'], 500);
        }
    }
}

