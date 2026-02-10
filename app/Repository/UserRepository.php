<?php
namespace App\Repository;
use App\Models\User;

class UserRepository
{
    public function FindById(int $id)
    {
    return User::find($id);
    }
    public function create(array $data)
    {
        return User::create($data);
    }
    public function update(User $user,array $data)
    {
        $user->update($data);
        return $user;
    }
    
    public function findByEmail($email)
    {
        return User::where('email',$email)->first();
    }
    public function getAll()
    {
        return User::all();
    }
    public function SoftDelete(int $Id): bool 
    {
        return User::where('id',$Id)->delete();
    }
    public function findWithtrashed(int $id)
    {
        return User::withTrashed()->find($id);

    }
    public function restore(int $id): bool 
    {
        return User::withTrashed()
        ->where('id',$id)
        ->restore();
    }
    
}
