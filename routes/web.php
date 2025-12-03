<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Events\MessageSent;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-message', function (Request $request) {
    event(new MessageSent($request->message));
    return response()->json(['status' => 'Message sent!']);
});


Route::get('', function (Request $request) {
    return view('home');});