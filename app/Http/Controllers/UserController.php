<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handler\UserHandler;

class UserController extends Controller
{
    protected UserHandler $handler;

    public function __construct(UserHandler $handler)
    {
        $this->handler = $handler;
    }

    public function register(Request $request)
    {
        $user = $this->handler->register($request->all());

        return response()->json([
            'message' => 'Register berhasil',
            'user' => $user
        ]);
    }

    public function cekSaldo(Request $request)
    {
        return response()->json([
            'saldo' => $request->user()->saldo
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->handler->login(
            $request->email,
            $request->password
        );

        return response()->json($user);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout berhasil']);
    }
    public function allUsers()
    {
    $users = $this->handler->allUsers();

    return response()->json([
        'users' => $users
    ]);
    }
}


