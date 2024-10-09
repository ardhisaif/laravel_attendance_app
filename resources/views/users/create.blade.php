<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="kelompok_id">Kelompok ID:</label>
        <input type="number" id="kelompok_id" name="kelompok_id" required><br><br>

        <label for="category_of_age">Category of Age:</label>
        <input type="number" id="category_of_age" name="category_of_age" required><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <button type="submit">Submit</button>
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
</body>
</html>
