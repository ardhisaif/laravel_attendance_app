<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
    <style>
        /* Gaya navbar dan form tetap sama */
        .navbar { background-color: #333; overflow: hidden; margin-bottom: 20px; }
        .navbar a { float: left; display: block; color: white; text-align: center; padding: 14px 20px; text-decoration: none; }
        .navbar a:hover { background-color: #ddd; color: black; }
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { margin-bottom: 20px; }
        form { margin-bottom: 40px; }
        label, select, input { display: block; margin-bottom: 10px; padding: 8px; }
        .status-hadir, .status-izin, .status-sakit { padding: 5px; border-radius: 3px; margin-bottom: 10px; }
        .status-hadir { background-color: rgb(139, 255, 139); }
        .status-izin { background-color: rgb(255, 255, 61); }
        .status-sakit { background-color: rgb(255, 188, 64); }
        ul { list-style-type: none; padding: 0; }
        li { margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h2>Record Attendance</h2>
    <form action="{{ route('presences.store', $event->id) }}" method="POST">
        @csrf
        <!-- Filter Kelompok -->
        <label for="kelompok_id">Select Kelompok:</label>
        <select name="kelompok_id" id="kelompok_id" required>
            <option value="">-- Select Kelompok --</option>
            @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
            @endforeach
        </select>

        <!-- Select Nama User (dengan pencarian) -->
        <label for="user_id">Select User:</label>
        <select name="user_id" id="user_id" required>
            <!-- User options akan diisi dengan JavaScript -->
        </select>

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

    <h1>Presence List for {{ $event->name }}</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($presences as $presence)
            <li>
                {{ $presence->user->name }} -
                @if($presence->status == 1)
                    <span class="status-hadir">Hadir</span>
                @elseif($presence->status == 2)
                    <span class="status-izin">Izin</span>
                @elseif($presence->status == 3)
                    <span class="status-sakit">Sakit</span>
                @endif
                - {{ $presence->description }}
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

    <!-- Tambahkan script untuk filter dan search -->
    <script>
        document.getElementById('kelompok_id').addEventListener('change', function() {
            var kelompokId = this.value;

            // Hapus user options sebelumnya
            var userSelect = document.getElementById('user_id');
            userSelect.innerHTML = '<option value="">-- Select User --</option>';

            // Buat permintaan AJAX ke server untuk mendapatkan daftar users berdasarkan kelompok
            if(kelompokId) {
                fetch(`/get-users-by-kelompok/${kelompokId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tambahkan user options ke dropdown
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
