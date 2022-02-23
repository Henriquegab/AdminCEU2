<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PagamentoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(
    function(){

        Route::resource('alunos', AlunoController::class);
        Route::resource('categorias', CategoriaController::class);
        Route::resource('pagamentos', PagamentoController::class);
        Route::post('/pagamentos/create2', [PagamentoController::class, 'create2'])->name('pagamentos.create2');
        
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        

    }

);


