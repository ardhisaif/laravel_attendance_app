<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
    <!-- Hubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" type="" href="{{ asset('css/styles.css') }}">

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript" ></script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Scan QR Code</h1>

    <div class="qr-scanner-container">
        <div id="reader" style="width: 500px; height: 500px;"></div>
        <div>
            <p>Hasil Scan: <span id="result"></span></p>
        </div>
    </div>

    <!-- Form untuk mencatat kehadiran -->
    <h2>Record Attendance</h2>
    <form id="attendance-form" action="{{ route('presences.store', $event->id) }}" method="POST" class="event-form">
        @csrf
            <!-- Input tersembunyi untuk menyimpan user_id dari hasil scan -->
            <input type="hidden" name="user_id" id="hidden_user_id">
            <!-- Input tersembunyi untuk status absen, otomatis Hadir -->
            <input type="hidden" name="status" value="1"> <!-- Status 1 untuk 'Hadir' -->

        <!-- Filter Kelompok -->
        <label for="kelompok_id">Select Kelompok:</label>
        <select name="kelompok_id" id="kelompok_id" required>
            <option value="">-- Select Kelompok --</option>
            @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
            @endforeach
        </select>

        <!-- Select Nama User -->
        <label for="user_id">Select User:</label>
        <select name="user_id" id="user_id" required></select>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="1">Hadir</option>
            <option value="2">Izin</option>
            <option value="3">Sakit</option>
        </select>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description">

        <button type="submit">Submit Attendance</button>
    </form>

    <!-- Tampilkan daftar kehadiran -->
    <h1>Presence List for {{ $event->name }}</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <ul class="user-list">
        @foreach($presences as $presence)
            <li>
                {{ $presence->user->name }} -
                @if($presence->status == 1)
                    <span class="status-hadir" style="color: green;">Hadir</span>
                @elseif($presence->status == 2)
                    <span class="status-izin" style="color: rgb(138, 138, 0);">Izin</span>
                @elseif($presence->status == 3)
                    <span class="status-sakit" style="color: rgb(128, 83, 0);">Sakit</span>
                @endif
                {{-- - {{ $presence->description }} --}}
            </li>
        @endforeach
    </ul>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script type="text/javascript">

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // Menampilkan hasil scan
            document.getElementById('result').innerText = decodedText;

            // Otomatis set user_id dari hasil scan
            document.getElementById('hidden_user_id').value = decodedText;

            // Otomatis submit form absensi
            document.getElementById('attendance-form').submit();


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

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: { width: 250, height: 250 }, facingMode: "user" },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        document.getElementById('kelompok_id').addEventListener('change', function() {
            var kelompokId = this.value;
            var userSelect = document.getElementById('user_id');
            userSelect.innerHTML = '<option value="">-- Select User --</option>';

            if (kelompokId) {
                fetch(`/get-users-by-kelompok/${kelompokId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(user => {
                            var option = document.createElement('option');
                            option.value = user.id;
                            option.text = user.name;
                            userSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
</body>
</html>
