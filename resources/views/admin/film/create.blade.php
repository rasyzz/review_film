<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Tambah Film</title>
</head>

<body>
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">TAMBAH DATA FILM</h1>
        </div>

        <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data"
            class="overflow-x-auto px-6">
            @csrf
            <div class="overflow-x-auto px-6 bg-light p-4 rounded shadow-sm border border-gray-300">
                
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Title -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Title:</label>
                    <input type="text" name="title" class="w-full border border-black rounded p-2" placeholder="Masukkan nama film" required>
                </div>

                <!-- Poster -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Poster:</label>
                    <input type="file" name="poster" class="w-full border border-black rounded p-2" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Description:</label>
                    <input type="text" name="description" class="w-full border border-black rounded p-2" placeholder="Masukkan deskripsi film" required>
                </div>

                <!-- Release Year -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Tahun Rilis:</label>
                    <input type="number" name="release_year" class="w-full border border-black rounded p-2" placeholder="Masukkan tahun rilis" required>
                </div>

                <!-- Duration -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Durasi (Menit):</label>
                    <input type="number" name="duration" class="w-full border border-black rounded p-2" placeholder="Masukkan durasi film" required>
                </div>

                <!-- Rating -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Rating:</label>
                    <input type="number" name="rating" class="w-full border border-black rounded p-2" placeholder="Masukkan rating film" required min="1" max="10">
                </div>

                <!-- Creator -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Creator:</label>
                    <input type="text" name="creator" class="w-full border border-black rounded p-2" placeholder="Masukkan nama creator" required>
                </div>

                <!-- Trailer -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Trailer:</label>
                    <input type="file" name="trailer" class="w-full border border-black rounded p-2">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>

</html>
    