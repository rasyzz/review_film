<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Tambah User</title>
</head>

<body>
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">TAMBAH DATA USER</h1>
        </div>

        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data"
            class="overflow-x-auto px-6">
            @csrf
            <div class=" overflow-x-auto px-6 bg-light p-4 rounded shadow-sm border border-gray-300">
                <div class="mb-3">
                    <label class="block text-sm font-bold">Name:</label>
                    <input type="text" name="name" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan nama" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Email:</label>
                    <input type="email" name="email" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan alamat email" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Password:</label>
                    <input type="password" name="password" class="w-full border border-black rounded p-2"
                        placeholder="Masukkan password" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Role:</label>
                    <select name="role" class="w-full border border-black rounded p-2" required>
                        <option value="">Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="author">Author</option>
                        <option value="user">Subscriber</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</body>

</html>
