<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    // Menampilkan QR code di halaman beserta tombol download
    public function showWithDownloadButton($id)
    {
        $qrCode = QrCode::generate($id);

        return view('qrcode', compact('qrCode', 'id'));
    }

    // Fungsi untuk mengunduh QR code
    public function download($id)
    {
        $qrCode = QrCode::format('png')->size(200)->generate($id);

        return response($qrCode, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="qrcode.png"',
        ]);
    }

    // Menampilkan halaman scan QR code
    public function scanPage()
    {
        return view('scan_qrcode');
    }
}
