<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript" ></script>
</head>
<body>
    <h1>Scan QR Code</h1>

    <!-- Area untuk menampilkan kamera dan hasil scan -->
    <div id="reader" style="width: 500px; height: 500px;"></div>
    <div>
        <p>Hasil Scan: <span id="result"></span></p>
    </div>

    <!-- Script untuk menjalankan scanner -->
    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            document.getElementById('result').innerText = decodedText;
            console.log(`Code matched = ${decodedText}`, decodedResult);

            html5QrcodeScanner.clear().then(_ => {
                console.log("QR Code scanning stopped.");
            }).catch(error => {
                console.error("Failed to clear QR Code scanner.", error);
            });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let config = { fps: 10, qrbox: { width: 250, height: 250} };

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        {facingMode: "user"},
        config,
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>
