<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>{{ $film->title }} - Show</title>
    <style>
        /* Custom CSS for background overlay */
        .background-overlay {
            background-image: url("{{ asset('storage/' . $film->poster) }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .background-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            /* Dark overlay */
            backdrop-filter: blur(10px);
            /* Blur effect */
        }

        .content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<script>
    function openModal() {
        document.getElementById("trailerModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("trailerModal").classList.add("hidden");
        document.getElementById("trailerVideo").pause(); // Hentikan video saat modal ditutup
    }
</script>


<body class="bg-gray-100">
    @include('navbar-author.sidebar')
    <div class="overflow-x-auto ml-64 mt-10 bg-slate-200">
        <div class="max-w-screen-xl mx-auto">
            <!-- Background Overlay Section -->
            <div class="background-overlay rounded-lg shadow-lg">
                <div class="content p-8">
                    <!-- Container for Poster and Details -->
                    <div class="flex flex-col md:flex-row">
                        <!-- Poster Section -->
                        <div class="w-full md:w-1/3 p-6">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Film Poster"
                                class="w-full h-auto rounded-lg shadow-md">
                        </div>

                        <!-- Film Details Section -->
                        <div class="w-full md:w-2/3 p-6 text-white">
                            <h1 class="text-4xl font-bold mb-6">{{ $film->title }}</h1>
                            <div class="space-y-4">
                                <p class="text-lg">
                                    <span class="font-semibold">Description:</span>
                                    <span class="block mt-1">{{ $film->description }}</span>
                                </p>
                                <p class="text-lg">
                                    <span class="font-semibold">Release Year:</span>
                                    <span class="block mt-1">{{ $film->release_year }}</span>
                                </p>
                                <p class="text-lg">
                                    <span class="font-semibold">Duration:</span>
                                    <span class="block mt-1">{{ $film->duration }} minutes</span>
                                </p>
                                <p class="text-lg">
                                    <span class="font-semibold">Director:</span>
                                    <span class="block mt-1">{{ $film->creator }}</span>
                                </p>
                                
                                <p class="text-lg">
                                    <span class="font-semibold">Trailer:</span>
                                    <span class="block mt-1">
                                        <!-- Watch Trailer Button (Opens Modal) -->
                                        <button onclick="openModal()"
                                            class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition">
                                            <i class="fas fa-play mr-2"></i>Watch Trailer
                                        </button>
                                    </span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <!-- Exit Button -->
                    <div class="mt-8 flex ml-5 mb-5">
                        <a href="{{ route('a.film.index') }}"
                            class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition">
                            <i class="fas fa-arrow-left mr-2"></i>Exit
                        </a>
                    </div>
                    
                    <!-- Modal Trailer (Tersembunyi Secara Default) -->
                    <div id="trailerModal"
                        class="hidden fixed inset-0  backdrop-blur-sm justify-center items-center ml-64">
                        <div class="p-4 max-w-2xl mx-auto mt-20 relative">
                            <h2 class="text-xl font-bold mb-4 text-white">{{ $film->title }} - Trailer</h2>

                            <!-- Tombol Close -->
                            <button onclick="closeModal()" class="absolute top-2 right-2 text-white hover:text-white">
                                <i class="fas fa-times text-2xl"></i>
                            </button>

                            <!-- Video Player -->
                            <video id="trailerVideo" controls class=" w-full mx-auto rounded-lg shadow-lg">
                                <source src="{{ asset('storage/' . $film->trailer) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
