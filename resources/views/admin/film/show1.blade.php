<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $film->title }}</title>
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Tailwind -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* Full screen background overlay with margin for sidebar */
        .main-content {
            margin-left: 220px;
            margin-top: 40px;
            min-height: 100vh;
            position: relative;
        }

        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('storage/' . $film->poster) }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(0, 0, 0, 0.75);
            background-blend-mode: darken;
            opacity: 0.8;
            z-index: -1;
        }


        .content-container {
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .modal {
            display: none;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal.active {
            display: flex;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('sidebar-navbar-admin.siidebar')

    <!-- Main Content with full screen background overlay -->
    <div class="main-content">
        <!-- Background overlay -->
        <div class="background-overlay"></div>

        <!-- Content container -->
        <div class="content-container">
            <div class="w-full mx-auto">
                <div class="container p-2 md:p-8">
                    <!-- Film content wrapper -->
                    <div class="flex flex-col md:flex-row gap-2 md:gap-4">
                        <!-- Poster -->
                        <div class="w-full md:w-2/4 h-auto max-w-xs mx-auto md:mx-0">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }} Poster"
                                class="w-full h-auto rounded-lg shadow-lg">
                        </div>

                        <!-- Details section -->
                        <div class="details w-full md:w-3/4 flex flex-col">
                            <!-- Title -->
                            <div class="title text-xl md:text-2xl font-bold mb-2 text-white">{{ $film->title }}</div>

                            <!-- Creator and release info -->
                            <div class="flex flex-wrap items-center gap-4 text-gray-300 text-sm md:text-lg">
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-video"></i>
                                    <span>By: {{ $film->creator }}</span>
                                </span>

                                <span class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $film->release_year }}</span>
                                </span>
                            </div>

                            <!-- Genres -->
                            <div class="flex flex-wrap items-center gap-2 mt-3 mb-3">
                                @foreach ($film->genres as $genre)
                                    <button
                                        class="bg-slate-300 text-black px-3 py-1 text-sm md:px-4 md:py-2 rounded-full">
                                        {{ $genre->title }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Description -->
                            <div class="description text-sm md:text-base mb-4 text-white">
                                {{ $film->description }}
                            </div>

                            <!-- Actions -->
                            <div class="actions mb-4">
                                <div class="flex flex-wrap items-center gap-4">
                                    <!-- Trailer button -->
                                    <button onclick="openModal()"
                                        class="border border-white text-white px-3 py-1 md:px-4 md:py-2 rounded-lg hover:bg-white hover:text-black transition flex items-center">
                                        <i class="fas fa-play mr-2"></i> Play Trailer
                                    </button>
                                    <!-- Separator only visible on larger screens -->
                                    <span class="hidden md:inline text-gray-500">|</span>
                                    <!-- Duration -->
                                    <span class="text-gray-300 text-sm md:text-lg">{{ $film->duration }} Menit</span>
                                </div>
                            </div>

                            <!-- Cast section -->
                            <span class="mt-2 text-white text-base md:text-lg">Aktor :</span>

                            <!-- Cast grid -->
                            <div class="credits grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-sm mt-3">
                                @foreach ($cast->castings as $casting)
                                    <div class="text-gray-400">
                                        <strong class="text-white">{{ $casting->real_name }}</strong>
                                        <br />
                                        sebagai ({{ $casting->stage_name }})
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Trailer -->
    <div id="trailerModal" class="modal fixed inset-0 flex justify-center items-center backdrop-blur-sm z-50">
        <div class="bg-gray-900 p-4 md:p-6 rounded-lg shadow-lg relative w-11/12 md:w-1/2">
            <h2 class="text-lg text-white md:text-xl font-bold mb-2 md:mb-4">
                {{ $film->title }} - Trailer
            </h2>
            <button onclick="closeModal()" class="absolute top-2 right-2 text-white hover:text-gray-400 text-2xl">
                <i class="fas fa-times"></i>
            </button>
            <video id="trailerVideo" controls class="w-full rounded-lg shadow-lg">
                <source src="{{ asset('storage/' . $film->trailer) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openModal() {
            document.getElementById("trailerModal").classList.add("active");
        }

        function closeModal() {
            document.getElementById("trailerModal").classList.remove("active");
            document.getElementById("trailerVideo").pause();
        }
    </script>
</body>

</html>
