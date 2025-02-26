<?php

use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PresenceController;
use Illuminate\Support\Facades\Route;

Route::get('/scan-qrcode', [QrCodeController::class, 'scanPage']);


Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/', [EventController::class, 'store'])->name('events.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::resource('users', UserController::class);
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::post('/users/presence', [PresenceController::class, 'storeWithNewUser'])->name('presences.storeWithNewUser');

Route::get('/{event}', [EventController::class, 'show'])->name('events.show'); // Halaman absensi

Route::put('/presences/{presence}', [PresenceController::class, 'update'])->name('presences.update');

Route::get('/{event}/presences', [PresenceController::class, 'index'])->name('presences.index');
Route::post('/{event}/presences', [PresenceController::class, 'store'])->name('presences.store');


Route::get('/qrcode/{id}', [QrCodeController::class, 'showWithDownloadButton']);
Route::get('/download/{id}', [QrCodeController::class, 'download']);


Route::resource('events', EventController::class);


Route::get('/get-users-by-kelompok/{kelompok_id}', [UserController::class, 'getUsersByKelompok']);
