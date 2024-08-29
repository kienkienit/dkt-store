<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;

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

        try {
            $user = $this->userService->registerUser($validatedData);
            auth()->login($user);

            return redirect()->route('home');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors([
                'registration' => 'An error occurred during registration. Please try again.',
            ])->withInput();
        }
    }
}
