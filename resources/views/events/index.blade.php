<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <!-- Menghubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>
    @if($events->isNotEmpty())
        <h1>Daftar Acara</h1>
    @endif

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <ul class="event-list">
        @foreach($events as $event)
            <li>
                <a href="{{ route('events.show', $event->id) }}" class="event-name">{{ $event->name }} - {{ $event->date }}</a>

                <!-- Edit dan Delete button berada dalam div agar rapi -->
                <div class="event-actions">
                    <a href="{{ route('events.edit', $event->id) }}" style="text-decoration: none;">
                        <button type="button" class="btn-edit">Edit</button>
                    </a>

                </div>
            </li>
        @endforeach
    </ul>

    <br/>

    <h2>Membuat Acara Baru</h2>
    <form action="{{ route('events.store') }}" method="POST" class="event-form">
        @csrf
        <label for="name">Nama Acara:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="category_of_age">Kategori Umur:</label>
        <select id="category_of_age" name="category_of_age" required>
            <option value="1">Caberawit</option>
            <option value="2">Pra-remaja</option>
            <option value="3">Remaja</option>
            <option value="4">Usia Nikah</option>
            <option value="5">Umum</option>
        </select><br><br>

        <label for="date">Tanggal Acara:</label>
        <input type="date" id="date" name="date" required><br><br>

        <button type="submit" class="btn-create">Create Event</button>
    </form>
</body>
</html>
