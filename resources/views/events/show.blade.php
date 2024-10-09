<!-- resources/views/events/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Attendance</title>
</head>
<body>
    <h1>{{ $event->name }} - {{ $event->date }}</h1>

    <h2>Submit Attendance</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('presences.store', $event->id) }}" method="POST">
        @csrf
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Submit Attendance</button>
    </form>

    <h2>Attendance List</h2>
    <ul>
        @foreach($presences as $presence)
            <li>{{ $presence->name }} - {{ $presence->email }}</li>
        @endforeach
    </ul>

    <a href="{{ route('events.index') }}">Back to Event List</a>
</body>
</html>
