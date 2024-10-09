<!-- resources/views/events/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
</head>
<body>
    <h1>List of Events</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($events as $event)
            <li>
                <a href="{{ route('events.show', $event->id) }}">{{ $event->name }} - {{ $event->date }}</a>
            </li>
        @endforeach
    </ul>

    <h2>Create New Event</h2>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="category_of_age">Category of Age:</label>
        <input type="number" id="category_of_age" name="category_of_age" required><br><br>

        <button type="submit">Create Event</button>
    </form>
</body>
</html>
