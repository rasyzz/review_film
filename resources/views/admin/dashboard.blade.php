<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Dashboard Admin Film</title>
</head>

<body class="bg-gray-100">
    @include('sidebar-navbar-admin.siidebar')

    <!-- Content Section -->
    <div class="ml-72 mr-8 mt-20 pb-10">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang di panel admin review film</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Total Users -->
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-500 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <i class="fas fa-users text-xl text-blue-500"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total User</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-2">
                    <a href="{{ route('user.index') }}"
                        class="text-sm text-blue-500 hover:text-blue-700 flex items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2: Total Movies -->
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-green-500 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <i class="fas fa-film text-xl text-green-500"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Film</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalFilms) }}</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-2">
                    <a href="{{ route('film.index') }}"
                        class="text-sm text-green-500 hover:text-green-700 flex items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3: Total Genres -->
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-purple-500 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-purple-100 p-3 mr-4">
                        <i class="fas fa-tags text-xl text-purple-500"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Genre</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalGenres) }}</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-2">
                    <a href="{{ route('genre.index') }}"
                        class="text-sm text-purple-500 hover:text-purple-700 flex items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Card 4: Total Castings -->
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-amber-500 hover:shadow-lg transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="rounded-full bg-amber-100 p-3 mr-4">
                        <i class="fas fa-user-tie text-xl text-amber-500"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Pemeran</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalCastings) }}</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-2">
                    <a href="{{ route('castings.index') }}"
                        class="text-sm text-amber-500 hover:text-amber-700 flex items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Comments Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Comments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                User</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Film</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Comment</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Rating</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($comments as $c)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-black">
                                        {{ $c->user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $c->film->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $c->comment }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $c->rating)
                                                <i class="fa fa-star text-yellow-500"></i>
                                            @else
                                                <i class="fa fa-star-o text-gray-300"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" onclick="showDeleteModal(this)"
                                        class="text-red-500 hover:text-red-700" title="Hapus" data-id="#">
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
</body>
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
                    <p class="text-white">Apakah Anda yakin ingin hapus komentar ini?</p>
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
        deleteForm.action = "#/" + currentItemId;

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

</html>
