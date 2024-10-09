<!-- resources/views/presences/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence for {{ $event->name }}</title>
</head>
<body>
    <h1>Presence List for {{ $event->name }}</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($presences as $presence)
            <li>{{ $presence->user->name }} - Status: {{ $presence->status }} - {{ $presence->description }}</li>
        @endforeach
    </ul>

    <h2>Record Attendance</h2>
    <form action="{{ route('presences.store', $event->id) }}" method="POST">
        @csrf
        <label for="user_id">Select User:</label>
        <select name="user_id" id="user_id" required>
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br><br>

        <label for="status">Status:</label>
        <input type="number" id="status" name="status" required><br><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description"><br><br>

        <button type="submit">Submit Attendance</button>
    </form>

    <a href="{{ route('events.index') }}">Back to Event List</a>
</body>
</html>
