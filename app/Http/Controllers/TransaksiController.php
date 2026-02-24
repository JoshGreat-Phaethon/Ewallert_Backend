<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handler\TransaksiHandler;
use App\Helpers\TransaksiSearchHelper;
use App\Models\Transaksi;
use App\Http\Resources\TransaksiResource;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\TopUpRequest;
use App\Helpers\ResponseHelper;
use App\Models\User;
use App\Helpers\UploadHelper;

class TransaksiController extends Controller
{
    protected TransaksiHandler $handler;

    public function __construct(TransaksiHandler $handler)
    {
        $this->handler = $handler;
    }

    public function topUp(TopUpRequest $request)
    {
        
        $user = $request->user();

        $imagePath = UploadHelper::uploadImage($request->file('image'));


        $transaksi = $this->handler->topUp(
            $user->id,
            $request->amount,
            $imagePath
        );

        return ResponseHelper::success(
            new TransaksiResource($transaksi),
            'TOP UP BERHASIL'
        );
    }

    public function transfer(TransferRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $transaksi = $this->handler->transfer(
            $user->id,
            $request->receiver_id,
            $request->amount
        );

        return ResponseHelper::success(
            new TransaksiResource($transaksi),
            'Transfer Berhasil'
        );
    }

    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $query = Transaksi::query()
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            })
            ->orderByDesc('created_at');

        $query = TransaksiSearchHelper::apply($query, $request);

        $transaksis = $query->paginate(10);

        return ResponseHelper::paginate(
            TransaksiResource::collection($transaksis),
            'Riwayat Transaksi'
        );
    }

}
