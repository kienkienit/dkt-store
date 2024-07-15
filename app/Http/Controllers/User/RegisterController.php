<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller 
{
    protected UserService $userService;

    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    public function showRegistrationForm() 
    {
        return view('auth.register');
    }

    public function register(RegisterUserRequest $request) 
    {
        $validatedData = $request->validated();
        $user = $this->userService->registerUser($validatedData);
        auth()->login($user);
        return redirect()->route('home');
    }
}
