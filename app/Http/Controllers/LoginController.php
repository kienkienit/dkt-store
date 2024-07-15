<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd(request());
        // $validatedData = $request->validate([
        //     'username' => 'required|string|max:255',
        //     'password' => 'required|string|min:8',
        // ]);

        $validatedData = $request->validated();

        $user = $this->userService->loginUser($validatedData);

        if ($user) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}
