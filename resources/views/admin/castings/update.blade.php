<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Edit Data Castings</title>
</head>

<body class="bg-gray-200">
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-gray-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">EDIT DATA CASTINGS</h1>
        </div>

        <form action="{{ route('castings.update', $casting->id_castings) }}" method="POST"
            class="overflow-x-auto px-6">
            @csrf
            @method('PUT')

            <div class="overflow-x-auto px-6 bg-light p-4 rounded shadow-sm border border-gray-300">

                <div class="mb-3">
                    <label class="block text-sm font-bold">Nama Panggung:</label>
                    <input type="text" name="stage_name" class="w-full border border-black rounded p-2"
                        value="{{ old('stage_name', $casting->stage_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Nama Asli:</label>
                    <input type="text" name="real_name" class="w-full border border-black rounded p-2"
                        value="{{ old('real_name', $casting->real_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Film:</label>
                    <select name="id_film" class="w-full border border-black rounded p-2" required>
                        <option value="">Pilih Film</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id_film }}"
                                {{ $casting->id_film == $film->id_film ? 'selected' : '' }}>
                                {{ $film->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>

</html>
