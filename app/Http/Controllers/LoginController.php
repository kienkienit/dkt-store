<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Services\UserService;

class LoginController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginUserRequest $request) 
    {
        $validatedData = $request->validated();
        $user = $this->userService->loginUser($validatedData);

        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.manage.products');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function showLoginAdminForm()
    {
        return view('admin.admin_login');
    }
}
