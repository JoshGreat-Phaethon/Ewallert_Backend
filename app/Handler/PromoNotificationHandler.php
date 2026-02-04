<?php

namespace App\Handler;

use App\Models\PromoNotification;
use App\Repository\PromoNotificationRepository;
use Illuminate\Database\Eloquent\Collection;

class PromoNotificationHandler
{
    protected PromoNotificationRepository $promoRepo;

    public function __construct(PromoNotificationRepository $promoRepo)
    {
        $this->promoRepo = $promoRepo;
    }

    public function create(array $data): PromoNotification
    {
        return $this->promoRepo->create([
            'title' => $data['title'],
            'message' => $data['message'],
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ]);
    }

    public function listActive(): Collection
    {
        return $this->promoRepo->getActive();
    }
}