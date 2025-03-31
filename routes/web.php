<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/update', [UserController::class, 'update'])->name('users.update');
Route::get('/registro-diario', function () {
    return view('registro-diario');
});


Route::resource('parametros', ParametroController::class);
Route::delete('/parametros/{fecha}', [ParametroController::class, 'destroy'])->name('parametros.destroy');
