<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handler\TransaksiHandler;
use App\Helpers\TransaksiSearchHelper;
use App\Models\Transaksi;
use App\Http\Resources\TransaksiResource; // ✅ FIX: singular
use App\Http\Requests\TransferRequest;
use App\Http\Requests\TopUpRequest;


class TransaksiController extends Controller
{
    protected TransaksiHandler $handler;

    public function __construct(TransaksiHandler $handler)
    {
        $this->handler = $handler;
    }

    public function topUp(TopUpRequest $request)
    {
       
        $imagePath = null;

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')
            ->store('transaksi','public');
        }

        $transaksi = $this->handler->topUp(
            $request->user()->id,
            $request->amount,
            $imagePath
        );

        return new TransaksiResource($transaksi);
            
        
    }

    public function transfer(TransferRequest $request)
    {
      
        $senderId = $request->user()->id;

        $transaksi = $this->handler->transfer(
            $request->user()->id,
            $request->receiver_id,
            $request->amount

        );

        return new TransaksiResource($transaksi);
         
    }

    public function index(Request $request)
    {
        $query = Transaksi::query()
            ->where(function ($q) {
                $q->where('sender_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
            })
            ->orderByDesc('created_at');

        $query = TransaksiSearchHelper::apply($query, $request);
       if ($request->query()) {
        $perPage = $request->get('per_page' , 10);
        $data = $query->paginate($perPage)->withQueryString();
       } else {
        $data = $query->get();
       }


        return TransaksiResource::collection($data); // ✅ FIX
    }
    
  
}
