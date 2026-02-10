<?php
namespace App\Handler;

use App\Repository\UserRepository;
use App\Repository\TransaksiRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Transaksi;

class TransaksiHandler
{
    protected $userRepo;
    protected $transaksiRepo;

    public function __construct(UserRepository $userRepo, TransaksiRepository $transaksiRepo)
    {
        $this->userRepo = $userRepo;
        $this->transaksiRepo = $transaksiRepo;
    }
    public function topUp(int $userId, int $amount, ?string $imagePath = null)
{
    return DB::transaction(function () use ($userId, $amount, $imagePath) {

        $user = $this->userRepo->findById($userId);
        if (!$user) {
            throw new Exception('User tidak ditemukan');
        }

        $user->saldo += $amount;
        $user->save();

        return $this->transaksiRepo->create([
            'receiver_id' => $userId,
            'amount' => $amount,
            'type' => 'topup',
            'image' => $imagePath,
            'saldo_left' => $user->saldo,
        ]);
    });


    
        
     }
     public function transfer(int $senderId, int $receiverId, int $amount)
{
    return DB::transaction(function () use ($senderId, $receiverId, $amount) {

        $sender = $this->userRepo->findById($senderId);
        $receiver = $this->userRepo->findById($receiverId);

        if (!$sender || !$receiver) {
            throw new Exception('User tidak ditemukan');
        }

        if ($sender->saldo < $amount) {
            throw new Exception('Saldo tidak cukup');
        }

        $sender->saldo -= $amount;
        $sender->save();

        $receiver->saldo += $amount;
        $receiver->save();

        return $this->transaksiRepo->create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'amount' => $amount,
            'type' => 'transfer',
            'saldo_left' => $sender->saldo,
        ]);
    });
    }

}
