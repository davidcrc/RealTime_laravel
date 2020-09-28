<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// P5-V2: Ruta para la vista que mostrara a los usuarios
Route::view('/users', 'users.showAll')->name('users.all');


// P6-V1 : La vista para un juego en tiempo real
Route::view('/game', 'game.show')->name('game.all');


// P7-V1 Controlador para la sala de chat
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'showChat'])->name('chat.show');


// P7-V4 Transmitiendo el mensaje a los usuarios
Route::post('/chat/message', [App\Http\Controllers\ChatController::class, 'messageReceived'])->name('chat.message');


