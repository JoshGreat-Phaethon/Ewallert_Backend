<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable

{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,HasFactory, Notifiable,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'saldo',
        
    ];
    protected function createdAt(): Attribute
{
    return Attribute::make(
        get: fn ($value) =>
            \Carbon\Carbon::parse($value)
                ->timezone('Asia/Jakarta')
                ->format('d-m-Y H:i:s') . ' WIB'
    );
}

protected function updatedAt(): Attribute
{
    return Attribute::make(
        get: fn ($value) =>
            \Carbon\Carbon::parse($value)
                ->timezone('Asia/Jakarta')
                ->format('d-m-Y H:i:s') . ' WIB'
    );
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'saldo'=>'decimal:2'
        ];
    }


    

    


    
    
    

}
