<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => $this->amount,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,

            'image_url' => $this->image
                ? asset('storage/' . $this->image)
                : null,

            'created_at' => $this->created_at
                ? $this->created_at->timezone('Asia/Jakarta')
                    ->format('d-m-Y H:i:s') . ' WIB'
                : null,

            'updated_at' => $this->updated_at
                ? $this->updated_at->timezone('Asia/Jakarta')
                    ->format('d-m-Y H:i:s') . ' WIB'
                : null,
        ];
    }
}
