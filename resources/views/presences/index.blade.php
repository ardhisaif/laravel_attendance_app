<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
    <!-- Hubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" type="" href="/css/styles.css">

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript" ></script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <br>
    <br>
    <!-- Form untuk mencatat kehadiran -->
    <h2>Form Absensi</h2>
    <form id="attendance-form" action="{{ route('presences.store', $event->id) }}" method="POST" class="event-form">
        @csrf
            <!-- Input tersembunyi untuk menyimpan user_id dari hasil scan -->
            <input type="hidden" name="user_id" id="hidden_user_id">
            <!-- Input tersembunyi untuk status absen, otomatis Hadir -->
            <input type="hidden" name="status" value="1"> <!-- Status 1 untuk 'Hadir' -->

        <!-- Filter Kelompok -->
        <label for="kelompok_id">Select Kelompok:</label>
        <select class="select-form" name="kelompok_id" id="kelompok_id" required>
            <option value="">-- Select Kelompok --</option>
            @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
            @endforeach
        </select>

        <!-- Select Nama User -->
        <label for="user_id">Select User:</label>
        <select class="select-form" name="user_id" id="user_id" required></select>

        <label for="status">Status:</label>
        <select class="select-form" id="status" name="status" required>
            <option value="1">Hadir</option>
            <option value="2">Izin</option>
            <option value="3">Sakit</option>
        </select>

        <label for="description">Deskripsi:</label>
        <input class="select-form" type="text" id="description" name="description">

        <button type="submit" class="btn-create">Submit</button>


        {{-- @if($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
    </form>


    <br>

    <!-- Tombol untuk membuka modal -->
    <div style="text-align: center;">
        <button id="openModalBtn">Absensi User Baru</button>
    </div>
    <br>

    <!-- Modal -->
    <div id="attendanceModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Form Absensi</h2>
            <form id="attendance-form" action="{{ route('presences.storeWithNewUser') }}" method="POST" class="event-form">
                @csrf
                <input type="hidden" name="status" value="1"> <!-- Status 1 untuk 'Hadir' -->
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <!-- Filter Kelompok -->
                <label for="kelompok_id">Select Kelompok:</label>
                <select class="select-form" name="kelompok_id" id="kelompok_id" required>
                    <option value="">-- Select Kelompok --</option>
                    @foreach($kelompoks as $kelompok)
                        <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
                    @endforeach
                </select>

                <!-- Input Nama User Baru -->
                <label for="new_user_name">Nama User Baru:</label>
                <input class="select-form" type="text" id="new_user_name" name="new_user_name" required>

                <label for="description">Deskripsi:</label>
                <input class="select-form" type="text" id="description" name="description">

                <button type="submit" class="btn-create">Submit</button>
            </form>
        </div>
    </div>

    @if($presences->isNotEmpty())
        <h1>Rekap Absensi {{ $event->name }}</h1>
        <div class="table-responsive">
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        @foreach($kelompoks as $kelompok)
                            <th>{{ $kelompok->name }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Variabel untuk menyimpan total global
                        $totalHadir = 0;
                        $totalIzin = 0;
                        $totalSakit = 0;
                    @endphp

                    {{-- Baris Hadir --}}
                    <tr>
                        <td>Hadir</td>
                        @foreach($kelompoks as $kelompok)
                            @php
                                $hadirCount = $presences->where('user.kelompok_id', $kelompok->id)
                                                        ->where('status', 1)
                                                        ->count();
                                $totalHadir += $hadirCount;
                            @endphp
                            <td>{{ $hadirCount }}</td>
                        @endforeach
                        <td>{{ $totalHadir }}</td>
                    </tr>

                    {{-- Baris Izin --}}
                    <tr>
                        <td>Izin</td>
                        @foreach($kelompoks as $kelompok)
                            @php
                                $izinCount = $presences->where('user.kelompok_id', $kelompok->id)
                                                    ->where('status', 2)
                                                    ->count();
                                $totalIzin += $izinCount;
                            @endphp
                            <td>{{ $izinCount }}</td>
                        @endforeach
                        <td>{{ $totalIzin }}</td>
                    </tr>

                    {{-- Baris Sakit --}}
                    <tr>
                        <td>Sakit</td>
                        @foreach($kelompoks as $kelompok)
                            @php
                                $sakitCount = $presences->where('user.kelompok_id', $kelompok->id)
                                                        ->where('status', 3)
                                                        ->count();
                                $totalSakit += $sakitCount;
                            @endphp
                            <td>{{ $sakitCount }}</td>
                        @endforeach
                        <td>{{ $totalSakit }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif

    <br>
    <br>

    <!-- Tampilkan daftar kehadiran -->

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($presences->isNotEmpty())
        <h1>Daftar Absensi {{ $event->name }}</h1>
        <div class="presence-list">
            @foreach($presences->groupBy('user.kelompok_id') as $kelompokId => $kelompokPresences)
                <h3 class="group-name">{{ $kelompoks->where('id', $kelompokId)->first()->name }}</h3>
                <ul class="user-list">
                    @foreach($kelompokPresences as $presence)
                        <li>
                            ~ {{ $presence->user->name }}
                            <form action="{{ route('presences.update', $presence->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="status-select">
                                    <option value="1" class="option-hadir" {{ $presence->status == 1 ? 'selected' : '' }}>Hadir</option>
                                    <option value="2" class="option-izin" {{ $presence->status == 2 ? 'selected' : '' }}>Izin</option>
                                    <option value="3" class="option-sakit" {{ $presence->status == 3 ? 'selected' : '' }}>Sakit</option>
                                    <option value="4" class="option-alpha" {{ $presence->status == 4 ? 'selected' : '' }}>Alpha</option>
                                </select>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    @endif



    <h1>Scan QR Code</h1>

    <div class="qr-scanner-container">
        <div id="reader" style="width: 200px; height: 500px;"></div>
        <div>
            <p>Hasil Scan: <span id="result"></span></p>
        </div>
    </div>

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
                fetch(`/get-users-by-kelompok/${kelompokId}`, {
                    method: "get",
                    headers: new Headers({
                        "ngrok-skip-browser-warning": "69420",
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        // Sort users alphabetically by name
                        data.sort((a, b) => a.name.localeCompare(b.name));
                        data.forEach(user => {
                            var option = document.createElement('option');
                            option.value = user.id;
                            option.text = user.name;
                            userSelect.appendChild(option);
                        });
                    });
            }
        });

        // Dapatkan elemen modal
        const modal = document.getElementById("attendanceModal");
        const btn = document.getElementById("openModalBtn");
        const span = document.getElementsByClassName("close")[0];

        // Buka modal saat tombol diklik
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Tutup modal saat tombol "X" diklik
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Tutup modal jika pengguna mengklik di luar modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        window.onload = function() {
            document.getElementById('kelompok_id').value = '';
            document.getElementById('user_id').innerHTML = '<option value="">-- Select User --</option>'; // Reset user_id
        };

        document.querySelectorAll('.status-select').forEach(select => {
            // Fungsi untuk mengatur kelas berdasarkan value
            const setClass = (selectElement) => {
                const value = selectElement.value;
                selectElement.classList.remove('status-hadir', 'status-izin', 'status-sakit');
                if (value === '1') {
                    selectElement.classList.add('status-hadir');
                } else if (value === '2') {
                    selectElement.classList.add('status-izin');
                } else if (value === '3') {
                    selectElement.classList.add('status-sakit');
                }
            };

            // Set kelas awal berdasarkan value default
            setClass(select);

            // Tambahkan event listener untuk mengubah kelas saat value berubah
            select.addEventListener('change', function() {
                setClass(this);
            });
        });

    </script>
</body>
</html>
