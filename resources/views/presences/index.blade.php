<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
    <!-- Hubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" type="" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <!-- Form untuk mencatat kehadiran -->
    <h2>Record Attendance</h2>
    <form action="{{ route('presences.store', $event->id) }}" method="POST" class="event-form">
        @csrf
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

    <script>
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
