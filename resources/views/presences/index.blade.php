<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
    <style>
        /* Gaya sederhana untuk navbar */
        .navbar {
            background-color: #333;
            overflow: hidden;
            margin-bottom: 20px; /* Tambahkan margin bawah untuk navbar */
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px; /* Tambahkan margin global untuk seluruh body */
        }

        h1, h2 {
            margin-bottom: 20px; /* Tambahkan margin bawah untuk heading */
        }

        form {
            margin-bottom: 40px; /* Tambahkan jarak bawah antara form dan list */
        }

        label, select, input {
            display: block;
            margin-bottom: 10px; /* Tambahkan margin bawah untuk elemen form */
            padding: 8px; /* Padding pada elemen form */
        }

        /* Background style untuk status */
        .status-hadir {
            background-color: rgb(139, 255, 139);
            color: rgb(0, 0, 0);
            padding: 5px;
            border-radius: 3px;
            margin-bottom: 10px; /* Tambahkan margin bawah untuk setiap status */
        }

        .status-izin {
            background-color: rgb(255, 255, 61);
            color: rgb(0, 0, 0);
            padding: 5px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .status-sakit {
            background-color: rgb(255, 188, 64);
            color: rgb(0, 0, 0);
            padding: 5px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none; /* Hapus bullet points */
            padding: 0; /* Hapus padding default pada ul */
        }

        li {
            margin-bottom: 15px; /* Tambahkan margin bawah antara list items */
            padding: 10px;
            border: 1px solid #ddd; /* Border untuk setiap list item */
            border-radius: 5px; /* Sedikit border radius untuk tampilan rapi */
        }
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
        <label for="user_id">Select User:</label>
        <select name="user_id" id="user_id" required>
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
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

</body>
</html>
