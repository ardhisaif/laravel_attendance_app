<?php

use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/qrcode/{id}', [QrCodeController::class, 'showWithDownloadButton']);
Route::get('/download/{id}', [QrCodeController::class, 'download']);

Route::get('/scan-qrcode', [QrCodeController::class, 'scanPage']);
