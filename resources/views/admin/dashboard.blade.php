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

        <!-- Recent Films Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Film Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Poster</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tahun</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentFilms as $film)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}"
                                        class="h-16 w-12 object-cover rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $film->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $film->release_year }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
