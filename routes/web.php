<?php

use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/qrcode/{id}', [QrCodeController::class, 'showWithDownloadButton']);
Route::get('/download/{id}', [QrCodeController::class, 'download']);

Route::get('/scan-qrcode', [QrCodeController::class, 'scanPage']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
