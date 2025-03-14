<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <title>Data Film</title>
</head>

<body class="bg-slate-200">
    @include('navbar-author.sidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide transition-colors duration-300">
                DATA FILM
            </h1>
        </div>

        <div class="flex items-center mb-6 px-6 p-3 space-x-4">
            <form action="/search" method="GET"
                class="flex items-center w-full max-w-sm bg-white rounded-lg p-1 shadow-sm border border-gray-300">
                <input type="text" name="query" placeholder="Cari movies..."
                    class="flex-grow bg-transparent outline-none px-3 text-gray-700 placeholder-gray-400 text-sm">
                <button type="submit"
                    class="bg-gray-800 text-white px-3 py-1 rounded-lg font-medium hover:bg-blue-700 transition-all duration-300 flex items-center text-sm">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
            </form>
            <a href="{{ route('a.film.create') }}"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center shadow-md text-sm">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Film
            </a>
        </div>

        <div class="overflow-x-auto px-6">
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden mb-10">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">Id</th>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Poster</th>
                        <th class="py-3 px-6 text-left">Tahun Rilis</th>
                        <th class="py-3 px-6 text-left">Sutradara</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($films as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6">{{ $item->id_film }}</td>
                            <td class="py-4 px-6">{{ $item->title }}</td>
                            <td class="py-4 px-6">
                                @if ($item->poster)
                                    <img src="{{ asset('storage/' . $item->poster) }}" alt="Poster" width="50">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">{{ $item->release_year }}</td>
                            <td class="py-4 px-6">{{ $item->creator }}</td>
                            <td class="py-4 px-6 flex justify-center items-center space-x-3">
                                <a href="{{ route('a.film.show', $item->id_film) }}"
                                    class="text-blue-500 hover:text-blue-700" title="Show">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('a.film.edit', $item->id_film) }}"
                                    class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                {{-- <form action="{{ route('film.destroy', $item->id_film) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input pencarian
            const searchInput = document.querySelector('input[name="query"]');

            // Jika ingin mencegah submit form (agar tidak reload halaman)
            const form = searchInput.closest('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });
            }

            // Tambahkan event listener untuk mendeteksi perubahan pada input
            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();
                // Ambil semua baris di dalam tbody
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(function(row) {
                    // Gabungkan teks dari seluruh baris dan ubah ke lowercase
                    const rowText = row.textContent.toLowerCase();
                    // Jika teks baris sesuai dengan input, tampilkan; jika tidak, sembunyikan
                    if (rowText.indexOf(filter) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>

</body>
<!-- Success Toast Notification - Hidden by default -->
@if (session('success'))
    <div id="successToast"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 translate-x-full flex items-center z-50 hidden">
        <div class="bg-white bg-opacity-25 p-1 rounded-full mr-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <span>{{ session('success') }}</span> <!-- Menampilkan pesan sukses dari session -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showSuccessToast();
        });

        function showSuccessToast() {
            const toast = document.getElementById('successToast');

            // Remove hidden class first to make the element visible
            toast.classList.remove('hidden');

            // Small delay to ensure transitions work properly after removing hidden
            setTimeout(() => {
                // Trigger the slide-in animation
                toast.classList.remove('translate-x-full');
                toast.classList.add('translate-x-0');
            }, 10);

            // Auto-hide after 3 seconds
            setTimeout(() => {
                // Start the slide-out animation
                toast.classList.remove('translate-x-0');
                toast.classList.add('translate-x-full');

                // Hide completely after animation completes
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300); // This duration should match your transition duration
            }, 3000);
        }
    </script>
@endif
</html>
