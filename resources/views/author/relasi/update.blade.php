<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Update Data Genre Film</title>
</head>

<body class="bg-slate-200">
    @include('navbar-author.sidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">UPDATE DATA GENRE FILM</h1>
        </div>


        {{-- Form untuk Edit Relasi --}}
        <form action="{{ route('a.relasi.update', $film->id_film) }}" method="POST" class="overflow-x-auto px-6">
            @csrf
            @method('PUT')

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

                <!-- Pilihan Film -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Film:</label>
                    <select name="film" class="w-full border border-black rounded p-2" required>
                        <option value="">Pilih Film</option>
                        @foreach ($filmList as $f)
                            <option value="{{ $f->id_film }}" {{ $f->id_film == $film->id_film ? 'selected' : '' }}>
                                {{ $f->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilihan Genre -->
                <div class="mb-3">
                    <label class="block text-sm font-bold">Genre:</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($genre as $genreItem)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="id_genre[]" value="{{ $genreItem->id_genre }}"
                                    class="border border-black rounded"
                                    {{ in_array($genreItem->id_genre, $selectedGenres) ? 'checked' : '' }}>
                                <span>{{ $genreItem->title }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>



    </div>
</body>

</html>
