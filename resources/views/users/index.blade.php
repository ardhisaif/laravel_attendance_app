<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <!-- Hubungkan dengan file CSS eksternal -->
    <link rel="stylesheet" type="" href="/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('users.index') }}">Users</a>
    </div>

    <h1>Input User</h1>
    <form action="{{ route('users.store') }}" method="POST" class="event-form">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br><br>

        <!-- Dropdown untuk memilih Kelompok -->
        <label for="kelompok_id">Kelompok:</label>
        <select id="kelompok_id" name="kelompok_id" required>
            @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id }}">{{ $kelompok->name }}</option>
            @endforeach
        </select><br><br>

        <label>Jenis Kelamin:</label>
        <label class="container">Laki-laki
            <input type="radio" id="male" name="gender" value="1" required>
            <span class="checkmark"></span>
        </label>
        <label class="container">Perempuan
            <input type="radio" id="female" name="gender" value="2" required>
            <span class="checkmark"></span>
        </label>
        <br>

        <label for="category_of_age">Kategori umur:</label>
        <select type="number" id="category_of_age" name="category_of_age" required>
            <option value="4">Usia Nikah</option>
            <option value="2">Pra-remaja</option>
            <option value="3">Remaja</option>
            <option value="1">Caberawit</option>
            <option value="5">Umum</option>
        </select><br><br>

        <label for="date_of_birth">Tanggal lahir:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="" ><br><br>

        <button type="submit" class="btn-edit">Kirim</button>
    </form>

    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan pesan error jika ada -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="user-list">
        @foreach($groupedUsers as $kelompokId => $users)
            <h3>Kelompok {{ $kelompoks->where('id', $kelompokId)->first()->name }}</h3>
            <ul>
                @foreach($users as $user)
                    <li>
                        <a href="{{ route('users.show', $user->id) }}" style="text-decoration: none; color: black;">
                            {{ $user->name }} <span>- {{ $user->email }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        // Pilih semua elemen kelompok (h3) di dalam user list
        const kelompokHeaders = document.querySelectorAll(".user-list h3");

        kelompokHeaders.forEach(header => {
            header.addEventListener("click", function() {
                // Temukan ul (list pengguna) yang terkait dengan header ini
                const userList = this.nextElementSibling;

                // Toggle class active untuk membuka atau menutup dropdown
                userList.classList.toggle("active");

                // Alternatif: Mengatur max-height secara dinamis berdasarkan tinggi konten
                if (userList.style.maxHeight) {
                    userList.style.maxHeight = null; // Tutup dropdown
                } else {
                    userList.style.maxHeight = userList.scrollHeight + "px"; // Buka dropdown
                }
            });
        });
    });
    </script>
</body>
</html>
