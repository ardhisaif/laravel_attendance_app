<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        /* Gaya sederhana untuk navbar */
        .navbar {
            background-color: #333;
            overflow: hidden;
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
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <!-- Dropdown untuk memilih Kelompok -->
        <label for="kelompok_id">Kelompok:</label>
        <select id="kelompok_id" name="kelompok_id" required>
            <option value="" disabled selected>Select a group</option>
            @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
            @endforeach
        </select><br><br>

        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="1" required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="2" required>
        <label for="female">Female</label><br><br>

        <label for="category_of_age">Category of Age:</label>
        <select type="number" id="category_of_age" name="category_of_age" required>
            <option value="1">Caberawit</option>
            <option value="2">Pra-remaja</option>
            <option value="3">Remaja</option>
            <option value="4">Usia Nikah</option>
            <option value="5">Umum</option>
        </select><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan pesan error jika ada -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>List of Users</h2>

    @foreach($groupedUsers as $kelompokId => $users)
        <h3>Group: {{ $kelompoks->where('id', $kelompokId)->first()->name }}</h3>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} - {{ $user->email }}</li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>
