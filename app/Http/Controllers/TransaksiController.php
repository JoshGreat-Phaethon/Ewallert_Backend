<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handler\TransaksiHandler;

class TransaksiController extends Controller
{
    protected TransaksiHandler $handler;

    public function __construct(TransaksiHandler $handler)
    {
        $this->handler = $handler;
    }

    public function topUp(Request $request)
    {
        $request->validate([
            'amount'  => 'required|numeric|min:1'
            
        ]);
        $user = $request->user();

        $transaksi = $this->handler->topUp(
            $user->id,
            $request->amount
        );

        return response()->json([
            'message' => 'Top Up berhasil',
            'transaksi' => $transaksi
        ]);
    }
    public function transfer(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
        ]);

        $senderId = $request->user()->id;

        $transaksi = $this->handler->transfer(
            $senderId,
            $data['receiver_id'],
            $data['amount']
        );
        return response()->json([
            'message'=> 'transfer berhasil',
            'transaksi' => $transaksi
        ]);
    }

    
}
