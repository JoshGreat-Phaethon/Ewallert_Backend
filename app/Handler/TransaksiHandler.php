<?php
namespace App\Handler;

use App\Repository\UserRepository;
use App\Repository\TransaksiRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaksiHandler
{
    protected $userRepo;
    protected $transaksiRepo;

    public function __construct(UserRepository $userRepo, TransaksiRepository $transaksiRepo)
    {
        $this->userRepo = $userRepo;
        $this->transaksiRepo = $transaksiRepo;
    }

    public function topUp($userId,$amount)
    {
        $user = $this->userRepo->FindById($userId);
        $user->saldo += $amount;
        $user->save();

        return $this->transaksiRepo->create([
            'receiver_id' =>$user->id,
            'amount' =>$amount,
            'type' => 'topup'
        ]);
    }
     public function transfer(int $senderId, int $receiverId, int $amount)
       {
        return DB::transaction(function () use ($senderId, $receiverId, $amount){
            //ambil user 
            $sender = $this->userRepo->findById($senderId);
            $receiver = $this->userRepo->findById($receiverId);

            if (!$sender || !$receiver) {
                throw new Exception('user Tidak DItemukan');
            }
            $sender->saldo -= $amount;
            $sender->save();

            $receiver->saldo += $amount;
            $receiver->save();

            return $this->transaksiRepo->create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'amount' => $amount,
                'type' => 'transfer'
            ]);
         });
        
       }
}
