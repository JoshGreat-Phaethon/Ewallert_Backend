
 <?php
 use App\Http\Controllers\UserController;
 use Illuminate\Support\Facades\Route;
 use Illuminate\Support\Facades\Auth;
 
Route::get('/', function () {
  return view('welcome');
  
});
Route::get('/login', function () {
    return view('login'); // atau nama file blade kamu
})->name('login');;
Route::get('/register', function () {
  return view('register');
 
});
Route::get('/topup', function () {
    return view('topup');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});


