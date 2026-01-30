<?php

namespace App\Handler;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;


class UserHandler
{
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        

        return $this->userRepo->create([
         'name' => $data['name'], 
         'email' =>$data['email'],
         'password' => bcrypt($data['password']),
         'saldo' => 0 

        ]);
        
    }

    public function cekSaldo($userId)
    {
        $user = $this->userRepo->findById($userId);

        return $user ? $user->saldo : null;
    }

    public function login($email,$password)
    {
        $user = $this->userRepo->findByEmail($email);

        if(!$user || !Hash::check($password,$user->password)) {
            throw new \Exception('Email atau password salah');

        }
        $token = $user->createToken('ewallet-token')->plainTextToken;
        return [
            'token' => $token,
            'user' => $user
        ];

    }    
    public function allUsers()
{
    return $this->userRepo->getAll();
}
}
