<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Edit Event</title>
</head>
<body>

    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Edit Event</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST" class="event-form">
        @csrf
        @method('PUT')

        <label for="name">Event Name:</label>
        <input class="select-form" type="text" id="name" name="name" value="{{ $event->name }}" required><br><br>

        <label for="category_of_age">Category of Age:</label>
        <select class="select-form" id="category_of_age" name="category_of_age" required>
            <option value="1" {{ $event->category_of_age == 1 ? 'selected' : '' }}>Caberawit</option>
            <option value="2" {{ $event->category_of_age == 2 ? 'selected' : '' }}>Pra-remaja</option>
            <option value="3" {{ $event->category_of_age == 3 ? 'selected' : '' }}>Remaja</option>
            <option value="4" {{ $event->category_of_age == 4 ? 'selected' : '' }}>Usia Nikah</option>
            <option value="5" {{ $event->category_of_age == 5 ? 'selected' : '' }}>Umum</option>
        </select><br><br>

        <label for="date">Date:</label>
        <input class="select-form" type="date" id="date" name="date" value="{{ $event->date }}" required><br><br>

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
