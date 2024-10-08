<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
</head>
<body>
    <h1>QR Code Generator</h1>

    <!-- Menampilkan QR Code -->
    <div>
        {!! $qrCode !!}
    </div>

    <!-- Tombol untuk mendownload QR Code -->
    <div style="margin-top: 20px;">
        <a href="{{ url('/download/' . $id) }}">
            <button>Download QR Code</button>
        </a>
    </div>
</body>
</html>
