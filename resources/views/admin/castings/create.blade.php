<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Tambah data castings</title>
</head>

<body>
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">TAMBAH DATA CASTINGS</h1>
        </div>

        <form action="{{ route('castings.store') }}" method="POST" enctype="multipart/form-data"
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

                <div class="mb-3">
                    <label class="block text-sm font-bold">Nama Panggung:</label>
                    <input type="text" name="stage_name" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan jawaban" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Nama Asli:</label>
                    <input type="text" name="real_name" class="w-full border border-black rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Film:</label>
                    <select name="id_film" class="w-full border border-black rounded p-2" required>
                        <option value="">Pilih Film</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id_film }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
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
