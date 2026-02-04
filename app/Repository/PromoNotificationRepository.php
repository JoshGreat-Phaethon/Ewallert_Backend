<?php

namespace App\Repository;

use App\Models\PromoNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PromoNotificationRepository
{
    public function create(array $data): PromoNotification
    {
        return PromoNotification::create($data);
    }

    public function getActive(): Collection
    {
        $now = Carbon::now();

        return PromoNotification::query()
            ->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', $now);
            })
            ->orderByDesc('id')
            ->get();
    }
}