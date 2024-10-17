<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail</title>

    <!-- Hubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>User Detail</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="event-form">
        <label for="name">Name:</label>
        <p>{{ $user->name }}</p>

        <label for="kelompok_id">Kelompok:</label>
        <p>{{ $user->kelompok->name }}</p> <!-- Asumsikan ada relasi ke kelompok -->

        <label for="category_of_age">Category of Age:</label>
        <p>{{ $user->category_of_age }}</p>

        <label for="date_of_birth">Date of Birth:</label>
        <p>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y') }}</p>

        <label for="email">Email:</label>
        <p>{{ $user->email }}</p>

        <div class="event-actions">
            <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
            </form>
        </div>
        <br>
        <a href="{{ route('users.index') }}" class="btn-create">Back to User List</a>
    </div>

</body>
</html>
