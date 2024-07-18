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

    public function paginateUsers($page)
    {
        return $this->userRepository->paginate($page);
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
