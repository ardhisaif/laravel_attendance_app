<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
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

        .event-actions {
            display: inline-block;
            margin-left: 20px;
        }

        button {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>List of Events</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach($events as $event)
            <li>
                <a href="{{ route('events.show', $event->id) }}">{{ $event->name }} - {{ $event->date }}</a>

                <!-- Edit button -->
                <a href="{{ route('events.edit', $event->id) }}" class="event-actions">
                    <button type="button">Edit</button>
                </a>

                <!-- Delete form -->
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="event-actions">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Create New Event</h2>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="category_of_age">Category of Age:</label>
        <select id="category_of_age" name="category_of_age" required>
            <option value="1">Caberawit</option>
            <option value="2">Pra-remaja</option>
            <option value="3">Remaja</option>
            <option value="4">Usia Nikah</option>
            <option value="5">Umum</option>
        </select><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <button type="submit">Create Event</button>
    </form>
</body>
</html>
