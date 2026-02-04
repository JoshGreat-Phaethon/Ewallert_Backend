<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PromoNotificationController;




    Route::post('/register',[UserController::class,'register']);
   

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',function (Request $request){
        return $request->user();
    });
    Route::post('/topup',[TransaksiController::class, 'topUp']);
    Route::post('/transfer',[TransaksiController::class, 'transfer']);
    Route::get('/saldo',[UserController::class,'cekSaldo']);
    Route::get('/promos', [PromoNotificationController::class, 'index']);
    Route::post('/logout',[UserController::class, 'logout']);
    Route::delete('/account',[UserController::class, 'deleteAccount']);

});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'allUsers']);
    Route::post('/admin/promos', [PromoNotificationController::class, 'store']);
});




Route::post('/login',[UserController::class, 'login']);
Route::post('/login',[UserController::class, 'login']);