<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\WorkerController;
use App\Models\Message;
use Illuminate\Support\Facades\Route;

Route::get('/',[MessageController::class,'index'])->name('messages.index');
Route::post('/store',[MessageController::class,'store'])->name('messages.store');


Route::get('/workers',[WorkerController::class,'index'])->name('workers.index');
Route::get('/workers-create',[WorkerController::class,'create'])->name('workers.create');
Route::post('/workers/store',[WorkerController::class,'store'])->name('workers.store');