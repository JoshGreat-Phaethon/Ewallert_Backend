<?php

namespace App\Handler;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Exception;


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
        return $user->saldo;
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

    public function deleteAccount(int $userId)
    {
        $user = $this->userRepo->findById($userId);

        if(!$user) {
            throw new Exception('user tidak ditemukan');

            
        }
        if ($user->saldo > 0) {
            throw new Exception('saldo harus 0');
        }

        return $this->userRepo->SoftDelete($userId);
    }
    public function restoreAccount(int $userId)
    {
        $user = $this->userRepo->findWithTrashed($userId);

        if (!$user) {
            throw new Exception('user tidak ada');
        }
        if (!$user->trashed()) {
            throw new Exception('user belum terhapus');
        }
        return $this->userRepo->restore($userId);

    }
    
}    
        

    
 
        
