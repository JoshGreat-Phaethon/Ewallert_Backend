<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;




    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class, 'login']);
   

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',function (Request $request){
        return $request->user();
    });
    Route::post('/topup',[TransaksiController::class, 'topUp']);
    Route::post('/transfer',[TransaksiController::class, 'transfer']);
    Route::get('/saldo',[UserController::class,'cekSaldo']);
    Route::post('/logout',[UserController::class, 'logout']);

});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'allUsers']);
});




