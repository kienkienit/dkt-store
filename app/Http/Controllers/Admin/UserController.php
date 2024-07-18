<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
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
        $users = $this->userService->paginateUsers($request->input('page', 1));
        if ($request->ajax()) {
            return response()->json([
                'users' => view('partials-admin.users', compact('users'))->render()
            ]);
        }

        return view('admin.manage_users', compact('users'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        $this->userService->createUser($data);

        return json_response(true, ['success' => 'Tài khoản đã được thêm thành công!']);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        $this->userService->updateUser($id, $data);

        return json_response(true, ['message' => 'Tài khoản đã được cập nhật thành công!']);
    }

    public function delete($id)
    {
        $this->userService->deleteUser($id);
        return json_response(true, ['message' => 'Tài khoản đã được xóa thành công!']);
    }
}
