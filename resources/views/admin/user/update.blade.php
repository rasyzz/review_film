<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Edit User</title>
</head>

<body class="bg-gray-100 min-h-screen">
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide">EDIT DATA USER</h1>
        </div>

        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="overflow-x-auto px-6">
            @csrf
            @method('PUT')

            <div class=" overflow-x-auto px-6 bg-light p-4 rounded shadow-sm border border-gray-300">
                <div class="mb-3">
                    <label class="block text-sm font-bold">Name:</label>
                    <input type="text" name="name"
                        class="w-full border border-black rounded p-2 focus:ring focus:ring-blue-300"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Email:</label>
                    <input type="email" name="email"
                        class="w-full border border-black rounded p-2 focus:ring focus:ring-blue-300"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Password (Kosongkan jika tidak ingin mengubah):</label>
                    <input type="password" name="password"
                        class="w-full border border-black rounded p-2 focus:ring focus:ring-blue-300"
                        placeholder="Masukkan password baru">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-bold">Role:</label>
                    <select name="role" class="w-full border border-black rounded p-2 focus:ring focus:ring-blue-300"
                        required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                        <option value="subscriber" {{ $user->role == 'subscriber' ? 'selected' : '' }}>Subscriber
                        </option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    </div>
</body>

</html>
