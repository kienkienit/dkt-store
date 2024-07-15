<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService 
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data) 
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';
        return $this->userRepository->create($data);
    }

    public function loginUser(array $credentials) 
    {
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return Auth::user();
        }
        
        return null;
    }
}
