<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class PromoNotification extends Model
{
    protected $fillable = [
        'title',
        'message',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
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
}