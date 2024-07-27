<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'process']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('admin', [DashboardController::class, 'index'])->middleware('auth')->name('admin');

Route::resource('/barang', BarangController::class)->middleware('auth');

Route::get('/', [PrincipalController::class, 'home']);


Route::get('apresentacao', [PrincipalController::class, 'apresentacao'])->name('principal.apresentacao');
Route::get('biblioteca', [PrincipalController::class, 'biblioteca'])->name('principal.biblioteca');
Route::get('contato', [PrincipalController::class, 'contato'])->name('principal.contato');
Route::get('instrucao', [PrincipalController::class, 'instrucao'])->name('principal.instrucao');
Route::get('libratos', [PrincipalController::class, 'libratos'])->name('principal.libratos');
Route::get('libror', [PrincipalController::class, 'libror'])->name('principal.libror');
Route::get('unifrazinho', [PrincipalController::class, 'unifrazinho'])->name('principal.unifrazinho');
Route::get('links', [PrincipalController::class, 'links'])->name('principal.links');

Route::post('enviamensagemchat', [PrincipalController::class, 'enviamensagemchat'])->name('principal.enviamensagemchat');
Route::post('verificarusuarioonline', [PrincipalController::class, 'verificarusuarioonline'])->name('principal.verificarusuarioonline');
Route::post('gravarmensagemchat', [PrincipalController::class, 'gravarmensagemchat'])->name('principal.gravarmensagemchat');
Route::post('idiomalink', [PrincipalController::class, 'idiomaLink'])->name('principal.idiomalink');

Route::post('fetch', [PrincipalController::class, 'fetch'])->name('principal.fetch');
Route::post('idiomapesquisado', [PrincipalController::class, 'idiomapesquisado'])->name('principal.idiomapesquisado');
Route::post('idiomatraduzir', [PrincipalController::class, 'idiomatraduzir'])->name('principal.idiomatraduzir');
Route::post('enviarfraseemail', [PrincipalController::class, 'enviarfraseemail'])->name('principal.enviarfraseemail');
Route::post('enviarcontato', [PrincipalController::class, 'enviarcontato'])->name('principal.enviarcontato');
Route::post('entrarchat', [PrincipalController::class, 'entrarchat'])->name('principal.entrarchat');
Route::post('sairchat', [PrincipalController::class, 'sairchat'])->name('principal.sairchat');


//idiomas.show
//frases.show
//user.show
//admin.edit


