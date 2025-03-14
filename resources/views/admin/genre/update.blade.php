<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Genre</title>
</head>

<body class="bg-gray-200 ">
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-gray-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">EDIT GENRE</h1>
        </div>

        <form action="{{ route('genre.update', $genre->id_genre) }}" method="POST" enctype="multipart/form-data"
            class="px-6">
            @csrf
            @method('PUT')

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-300">
                <div class="mb-4">
                    <label class="block text-sm font-bold">Title:</label>
                    <input type="text" name="title"
                        class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-blue-300"
                        value="{{ old('title', $genre->title) }}" required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>

</html>
