<!-- resources/views/users/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
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
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>

            <label for="kelompok_id">Kelompok:</label>
            <select name="kelompok_id" id="kelompok_id" required>
                @foreach($kelompoks as $kelompok)
                    <option value="{{ $kelompok->id }}" {{ $user->kelompok_id == $kelompok->id ? 'selected' : '' }}>
                        {{ $kelompok->name }}
                    </option>
                @endforeach
            </select>

            <label for="category_of_age">Category of Age:</label>
            <input type="number" name="category_of_age" id="category_of_age" value="{{ old('category_of_age', $user->category_of_age) }}" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) ?? '' }}">

            <button type="submit" class="btn-save">Save</button>
        </div>
    </form>

    <br>
    <a href="{{ route('users.show', $user->id) }}" class="btn-create">Back to User Detail</a>
</body>
</html>
