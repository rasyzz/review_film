<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Data Castings</title>
</head>

<body class="bg-slate-200">
    @include('sidebar-navbar-admin.siidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="py-8 flex justify-center">
            <h1 class="text-4xl font-extrabold text-gray-900 uppercase tracking-wide transition-colors duration-300">
                DATA CASTINGS
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
            <a href="{{ route('castings.create') }}"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center shadow-md text-sm">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Data
            </a>
        </div>

        <div class="overflow-x-auto px-6">
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden mb-10">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Panggung</th>
                        <th class="py-3 px-6 text-left">Nama Asli</th>
                        <th class="py-3 px-6 text-left">Id Film</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 ">
                    @foreach ($casting as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6">{{ $item->id_castings }}</td>
                            <td class="py-4 px-6">{{ $item->stage_name }}</td>
                            <td class="py-4 px-6">{{ $item->real_name }}</td>
                            <td class="py-4 px-6">{{ $item->film->title }}</td>
                            <td class="py-4 px-6 flex justify-center items-center space-x-3">
                                <a href="{{ route('castings.edit', $item->id_castings) }}"
                                    class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" onclick="showDeleteModal(this)"
                                    class="text-red-500 hover:text-red-700" title="Hapus"
                                    data-id="{{ $item->id_castings }}">
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal"
        class="fixed inset-0 bg-transparent flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-blue-900 backdrop-blur-md rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-transform duration-300 scale-95 opacity-0 border border-gray-200"
            id="deleteModalContent">
            <div class="p-6">

                <div class="mb-5">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-100 p-2 rounded-full mr-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-white">Apakah Anda yakin ingin data ini?</p>
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
            deleteForm.action = "{{ route('castings.destroy', '') }}/" + currentItemId;

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
