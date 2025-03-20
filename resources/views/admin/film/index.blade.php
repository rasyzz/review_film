<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <title>Data Film</title>
</head>

<body class="bg-slate-200">
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide transition-colors duration-300">
                DATA FILM
            </h1>
        </div>

        <!-- Modified flex container with filters -->
        <div class="flex items-center mb-6 px-6 p-3 space-x-4 flex-wrap">
            <!-- Search form remains the same -->
            <form action="/search" method="GET"
                class="flex items-center w-full max-w-sm bg-white rounded-lg p-1 shadow-sm border border-gray-300">
                <input type="text" name="query" id="searchInput" placeholder="Cari movies..."
                    class="flex-grow bg-transparent outline-none px-3 text-gray-700 placeholder-gray-400 text-sm">
                <button type="submit"
                    class="bg-gray-800 text-white px-3 py-1 rounded-lg font-medium hover:bg-blue-700 transition-all duration-300 flex items-center text-sm">
                    <i class="fas fa-search mr-2"></i> Cari
                </button>
            </form>

            <!-- Genre Filter -->
            <div class="relative w-48">
                <form id="genreFilterForm" action="{{ route('film.index') }}" method="GET" class="m-0 p-0">
                    <!-- Preserve other active filters -->
                    @if (request()->has('year'))
                        <input type="hidden" name="year" value="{{ request('year') }}">
                    @endif
                    @if (request()->has('query'))
                        <input type="hidden" name="query" value="{{ request('query') }}">
                    @endif

                    <select name="genre" id="genreFilter" onchange="this.form.submit()"
                        class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id_genre }}"
                                {{ request('genres') == $genre->id_genre ? 'selected' : '' }}>
                                {{ $genre->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </div>
                </form>
            </div>

            <!-- Year Filter -->
            <div class="relative w-48">
                <form id="yearFilterForm" action="{{ route('film.index') }}" method="GET" class="m-0 p-0">
                    <!-- Preserve other active filters -->
                    @if (request()->has('genres'))
                        <input type="hidden" name="genres" value="{{ request('genres') }}">
                    @endif
                    @if (request()->has('query'))
                        <input type="hidden" name="query" value="{{ request('query') }}">
                    @endif

                    <select name="year" id="yearFilter" onchange="this.form.submit()"
                        class="w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-700 text-sm appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </div>
                </form>
            </div>

            <!-- Reset Filters Button -->
            <a href="{{ route('film.index') }}"
                class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-opacity-50 flex items-center shadow-md text-sm">
                <i class="fas fa-sync-alt mr-2"></i> Reset
            </a>

            <!-- Tambah Film Button -->
            <a href="{{ route('film.create') }}"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center shadow-md text-sm">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Film
            </a>
        </div>


        <div class="px-6">
            <div class="overflow-hidden border border-gray-300 rounded-lg shadow-md mb-10">
                <!-- Header tabel yang tetap -->
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Poster</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Title</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Rilis</th>
                            <th scope="col"
                                class="px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Sutradara</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Genre</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                </table>

                <!-- Body tabel yang dapat di-scroll -->
                <div class="overflow-y-auto max-h-96">
                    <table class="min-w-full bg-white">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($f as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <div class="text-sm font-medium text-black">
                                            @if ($item->poster)
                                                <img src="{{ asset('storage/' . $item->poster) }}" alt="Poster"
                                                    width="50">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->title }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->release_year }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->creator }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <div class="text-sm text-gray-900">
                                            @if ($item->genres->isNotEmpty())
                                                {{ $item->genres->pluck('title')->join(', ') }}
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="width: 16.67%">
                                        <a href="{{ route('film.show', $item->id_film) }}"
                                            class="text-blue-500 hover:text-blue-700" title="Show">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('film.edit', $item->id_film) }}"
                                            class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" onclick="showDeleteModal(this)"
                                            class="text-red-500 hover:text-red-700" title="Hapus"
                                            data-id="{{ $item->id_film }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="deleteForm" method="POST" action="" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirmModal"
            class="fixed inset-0 bg-transparent flex items-center justify-center z-50 hidden transition-opacity duration-300">
            <div class="bg-blue-900 backdrop-blur-md rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-transform duration-300 scale-95 opacity-0 border border-gray-200"
                id="deleteModalContent">
                <div class="p-6">

                    <div class="mb-5">
                        <div class="flex items-center mb-4">
                            <div class="bg-red-100 p-2 rounded-full mr-3">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-white">Apakah Anda yakin ingin hapus data ini?</p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button onclick="closeDeleteModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-white hover:bg-gray-50 hover:text-gray-700 transition-colors">
                            Tidak
                        </button>
                        <button onclick="confirmDelete()"
                            class="px-4 py-2 bg-red-600 rounded-lg text-white hover:bg-red-700 transition-colors flex items-center">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- JavaScript for Modal and Toast Functionality -->
        <script>
            // Global variable to store the current item ID
            let currentItemId = null;

            function showDeleteModal(button) {
                // Get the ID from data attribute
                currentItemId = button.getAttribute('data-id');

                const modal = document.getElementById('deleteConfirmModal');
                const modalContent = document.getElementById('deleteModalContent');

                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('bg-black', 'bg-opacity-50');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteConfirmModal');
                const modalContent = document.getElementById('deleteModalContent');

                modal.classList.remove('bg-black', 'bg-opacity-50');
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            function confirmDelete() {
                // Set the form action with the current item ID
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = "{{ route('film.destroy', '') }}/" + currentItemId;

                // Submit the form
                deleteForm.submit();

                // Close the modal
                closeDeleteModal();

                // Show success toast notification after form submission
                // This will appear immediately, which assumes the form submission is successful
                // In a real app, you might want to show this toast after a successful AJAX response
                showSuccessToast();
            }
        </script>
        {{-- cari --}}
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
        {{-- filter --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Client-side search functionality for quicker feedback
                const searchInput = document.getElementById('searchInput');

                if (searchInput) {
                    searchInput.addEventListener('keyup', function() {
                        performClientSideFilter();
                    });
                }

                // Function to perform client-side filtering
                function performClientSideFilter() {
                    const searchValue = searchInput ? searchInput.value.toLowerCase() : '';
                    const genreValue = document.getElementById('genreFilter').value;
                    const yearValue = document.getElementById('yearFilter').value;

                    // Only filter on client-side if we're not submitting the form yet
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(function(row) {
                        let displayRow = true;
                        const rowText = row.textContent.toLowerCase();

                        // Simple search filtering
                        if (searchValue && rowText.indexOf(searchValue) === -1) {
                            displayRow = false;
                        }

                        // Show or hide row
                        row.style.display = displayRow ? '' : 'none';
                    });
                }

                // Prevent double-submits by disabling buttons momentarily after click
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const buttons = this.querySelectorAll('button[type="submit"]');
                        buttons.forEach(button => {
                            button.disabled = true;
                            button.innerHTML =
                                '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';

                            // Re-enable after 2 seconds in case of error
                            setTimeout(() => {
                                button.disabled = false;
                                button.innerHTML =
                                    '<i class="fas fa-search mr-2"></i> Cari';
                            }, 2000);
                        });
                    });
                });

                // Add visual feedback when filters are active
                function highlightActiveFilters() {
                    const activeElements = document.querySelectorAll('select[name="genre"], select[name="year"]');

                    activeElements.forEach(element => {
                        if (element.value) {
                            // Add a visual indicator that this filter is active
                            element.classList.add('border-blue-500', 'bg-blue-50');

                            // Add a filter-active indicator to the parent container
                            const parent = element.closest('.relative');
                            if (parent) {
                                const indicator = document.createElement('span');
                                indicator.className =
                                    'absolute -top-2 -right-2 bg-blue-500 rounded-full w-3 h-3';

                                // Only add if it doesn't exist
                                if (!parent.querySelector('.absolute.-top-2.-right-2')) {
                                    parent.appendChild(indicator);
                                }
                            }
                        }
                    });
                }

                // Call highlight function on page load
                highlightActiveFilters();
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
