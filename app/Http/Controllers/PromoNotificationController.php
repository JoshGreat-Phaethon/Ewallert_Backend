<?php

namespace App\Http\Controllers;

use App\Handler\PromoNotificationHandler;
use Illuminate\Http\Request;

class PromoNotificationController extends Controller
{
    protected PromoNotificationHandler $handler;

    public function __construct(PromoNotificationHandler $handler)
    {
        $this->handler = $handler;
    }

    public function index()
    {
        $promos = $this->handler->listActive();

        return response()->json([
            'promos' => $promos,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        $promo = $this->handler->create($data);

        return response()->json([
            'message' => 'Promo berhasil dibuat',
            'promo' => $promo,
        ], 201);
    }
}