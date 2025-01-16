<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Edit User</h1>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="event-form">
            <label for="name">Nama:</label>
            <input class="select-form" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>

            <label for="kelompok_id">Kelompok:</label>
            <select class="select-form" name="kelompok_id" id="kelompok_id" required>
                @foreach($kelompoks as $kelompok)
                    <option value="{{ $kelompok->id }}" {{ $user->kelompok_id == $kelompok->id ? 'selected' : '' }}>
                        {{ $kelompok->name }}
                    </option>
                @endforeach
            </select>

            <label for="category_of_age">Kategori umur:</label>
            <select class="select-form" type="number" id="category_of_age" name="category_of_age" required>
                <option value="4">Usia Nikah</option>
                <option value="2">Pra-remaja</option>
                <option value="3">Remaja</option>
                <option value="1">Caberawit</option>
                <option value="5">Umum</option>
            </select><br>

            <label for="date_of_birth">Tanggal lahir:</label>
            <input class="select-form" type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">

            <label for="email">Email:</label>
            <input class="select-form" type="email" name="email" id="email" value="{{ old('email', $user->email) ?? '' }}">

            <button type="submit" class="btn-edit">Simpan</button>
        </div>
    </form>

    <br>
    <a href="{{ route('users.show', $user->id) }}" class="btn-create">Back to User Detail</a>
</body>
</html>
