<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <!-- Tambahkan pustaka html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Detail User</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div id="user-details" class="event-form">
        <!-- Bagian QR Code -->
        <div style="text-align: center;">
            {!! QrCode::size(200)->generate($user->id) !!}
        </div>

        <label for="name">Nama:</label>
        <p>{{ $user->name }}</p>

        <label for="kelompok_id">Kelompok:</label>
        <p>{{ $user->kelompok->name }}</p>

        <label for="category_of_age">Kategori Umur:</label>
        <p>
            @switch($user->category_of_age)
            @case(1)
                Caberawit
                @break
            @case(2)
                Pra-remaja
                @break
            @case(3)
                Remaja
                @break
            @case(4)
                Usia Nikah
                @break
            @case(5)
                Umum
                @break
            @default
                Unknown
            @endswitch
        </p>

        @if($user->date_of_birth)
            <label for="date_of_birth">Tanggal Lahir:</label>
            <p>{{ \Carbon\Carbon::parse($user->date_of_birth)->translatedFormat('j F Y') }}</p>
        @endif

        @if($user->email)
            <label for="email">Email:</label>
            <p>{{ $user->email }}</p>
        @endif

        <div class="event-actions">
            <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit user</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Hapus</button>
            </form>
        </div>
        <br>
    </div>

    <div style="text-align: center;">
        <a href="{{ route('users.index') }}" class="btn-create">Kembali ke daftar user</a>
    </div>

    <!-- Tombol Download -->
    <div style="text-align: center; margin-top: 20px;">
        <button id="downloadBtn">Download as JPG</button>
    </div>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function () {
            const element = document.getElementById('user-details');
            html2canvas(element).then((canvas) => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/jpeg');
                link.download = 'user-details.jpg';
                link.click();
            });
        });
    </script>
</body>
</html>
