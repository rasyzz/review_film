<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Edit Data Film</title>
</head>

<body>
    @include('navbar-author.sidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">EDIT DATA FILM</h1>
        </div>

        <form action="{{ route('a.film.update', $film->id_film) }}" method="POST" enctype="multipart/form-data"
            class="overflow-x-auto px-6">
            @csrf
            @method('PUT')

            <div class="overflow-x-auto px-6 bg-light p-4 rounded shadow-sm border border-gray-300">
                <div class="mb-3">
                    <label class="block text-sm font-bold">Title:</label>
                    <input type="text" name="title" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan nama" value="{{ old('title', $film->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Poster:</label>
                    <input type="file" name="poster" class="w-full border border-black rounded p-2">
                    @if ($film->poster)
                        <p class="mt-2 text-sm">Poster yang ada:</p>
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="mt-2 max-w-xs">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Description:</label>
                    <input type="text" name="description" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan description" value="{{ old('description', $film->description) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Tahun Rilis:</label>
                    <input type="number" name="release_year" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan tahun rilis" value="{{ old('release_year', $film->release_year) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Durasi:</label>
                    <input type="number" name="duration" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan durasi" value="{{ old('duration', $film->duration) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Rating:</label>
                    <input type="number" name="rating" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan rating" value="{{ old('rating', $film->rating) }}">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Creator:</label>
                    <input type="text" name="creator" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan creator" value="{{ old('creator', $film->creator) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Trailer:</label>
                    <input type="file" name="trailer" class="w-full border border-black rounded p-2">

                    @if ($film->trailer)
                        <p class="mt-2 text-sm">Trailer yang ada:</p>
                        <video class="mt-2 w-full max-w-lg rounded-lg shadow-lg" controls>
                            <source src="{{ asset('storage/' . $film->trailer) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    @endif
                </div>


                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>
