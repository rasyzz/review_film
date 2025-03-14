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
        .container {
            display: flex;
            max-width: 600%;
        }


        .poster {
            padding: 10px;
            flex: 1;
            margin-right: 0px;
        }

        .poster img {
            width: 100%;
            border-radius: 10px;
        }

        .details {
            flex: 2;
            margin-left: 20px;
        }

        .title {
            font-size: 2em;
            font-weight: 700;
        }



        .rating {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .rating .score {
            background-color: #1db954;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            font-weight: 700;
            margin-right: 10px;
        }

        .rating .text {
            font-size: 1em;
        }



        .description {
            margin-bottom: 20px;
            font-size: 1em;
            color: #cccccc;
        }



        /* Background Overlay */
        .background-overlay {
            background-image: url("{{ asset('storage/' . $film->poster) }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            padding: 7px;
        }

        .background-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
            backdrop-filter: blur(5px);
        }

        /* Modal Animation */
        .modal {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<script>
    function openModal() {
        document.getElementById("trailerModal").classList.add("active");
    }

    function closeModal() {
        document.getElementById("trailerModal").classList.remove("active");
        document.getElementById("trailerVideo").pause();
    }
</script>

<body class="bg-gray-900 text-white">
    @include('navbar-anonymous.navbar')

    <div class="overflow-x-auto mt-35 md:mt-40">

        <div class="background-overlay rounded-lg shadow-lg mx-2 md:mx-7">
            <div class="w-full mx-auto">
                <div class="container p-4 md:p-8 relative">
                    <!-- Film content wrapper - stack vertically on mobile, side by side on desktop -->
                    <div class="flex flex-col md:flex-row gap-2 md:gap-4">
                        <!-- Poster - full width on mobile, 1/4 width on desktop -->
                        <div class="w-full md:w-1/4 h-auto max-w-xs mx-auto md:mx-0">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Film Poster"
                                class="w-full h-auto rounded-lg shadow-lg">
                        </div>

                        <!-- Details section - full width on mobile, 3/4 width on desktop -->
                        <div class="details w-full md:w-3/4 flex flex-col">
                            <!-- Title -->
                            <div class="title text-xl md:text-2xl font-bold mb-2">{{ $film->title }}</div>

                            <!-- Creator and release info - stack on very small screens -->
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

                            <!-- Genres - wrap on smaller screens -->
                            <div class="flex flex-wrap items-center gap-2 mt-3 mb-3">
                                @foreach ($film->genres as $genre)
                                    <button
                                        class="bg-slate-300 text-black px-3 py-1 text-sm md:px-4 md:py-2 rounded-full">
                                        {{ $genre->title }}
                                    </button>
                                @endforeach
                            </div>

                            <!-- Description -->
                            <div class="description text-sm md:text-base mb-4">
                                {{ $film->description }}
                            </div>

                            <!-- Actions -->
                            <div class="actions mb-4">
                                <div class="play-trailer">
                                    <div class="flex flex-wrap items-center gap-4">
                                        <!-- Trailer button -->
                                        <button onclick="openModal()"
                                            class="border border-white text-white px-3 py-1 md:px-4 md:py-2 rounded-lg hover:bg-white hover:text-black transition flex items-center">
                                            <i class="fas fa-play mr-2"></i> Play Trailer
                                        </button>
                                        <!-- Separator only visible on larger screens -->
                                        <span class="hidden md:inline text-gray-500">|</span>
                                        <!-- Duration -->
                                        <span class="text-gray-300 text-sm md:text-lg">{{ $film->duration }}
                                            Menit</span>
                                    </div>

                                    <!-- Modal Trailer -->
                                    <div id="trailerModal"
                                        class="modal fixed inset-0 flex justify-center items-center backdrop-blur-sm z-50">
                                        <div
                                            class="bg-gray-900 p-4 md:p-6 rounded-lg shadow-lg relative w-11/12 md:w-1/2">
                                            <h2 class="text-lg md:text-xl font-bold mb-2 md:mb-4">{{ $film->title }} -
                                                Trailer</h2>
                                            <button onclick="closeModal()"
                                                class="absolute top-2 right-2 text-white hover:text-gray-400 text-2xl">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <video id="trailerVideo" controls class="w-full rounded-lg shadow-lg">
                                                <source src="{{ asset('storage/' . $film->trailer) }}"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating -->
                            @php
                                // Calculate average rating and total ratings
                                $averageRating = $film->comments->avg('rating');
                                $totalRates = $film->comments->count();
                                // Round rating for full stars
                                $roundedRating = round($averageRating);
                            @endphp

                            <div class="rating flex items-center mb-6 md:mb-20">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 md:w-8 md:h-8 mx-1 {{ $i <= $roundedRating ? 'text-yellow-300' : 'text-gray-300' }}"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor

                                <!-- Average rating and total -->
                                <span class="ml-2 md:ml-3 text-gray-600 text-sm md:text-lg">
                                    {{ number_format($averageRating, 1) }}
                                    ({{ $totalRates }} rates)
                                </span>
                            </div>

                            <!-- Cast section -->
                            <span class="mt-2 text-white text-base md:text-lg">
                                Aktor :
                            </span>

                            <!-- Cast grid for better mobile layout -->
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

        <!-- Container untuk Tambah Komentar dan Daftar Komentar -->
        <div class="w-full h-auto bg-gray-900 p-5 flex flex-col space-y-6">
            <!-- Tambah Komentar -->
            <div class="w-full bg-white text-black p-6 rounded-lg shadow-lg border border-black">
                <form action="#" method="post" class="space-y-4">
                    <!-- Rating Section -->
                    <div class="rating1 flex flex-col items-center space-y-4 mb-2">
                        <div class="rating flex flex-wrap justify-center gap-x-2 sm:gap-x-4">
                            <input type="radio" name="rating" id="star5" value="5" class="hidden">
                            <label for="star5"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star4" value="4" class="hidden">
                            <label for="star4"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star3" value="3" class="hidden">
                            <label for="star3"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star2" value="2" class="hidden">
                            <label for="star2"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star1" value="1" class="hidden">
                            <label for="star1"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Komentar :</h2>
                    <!-- Komentar Section -->
                    <textarea name="komentar" placeholder="Tulis komentar Anda..." required
                        class="w-full p-2 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-white border border-black text-blue-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200 transition"
                        onclick="checkLogin(event)">Kirim</button>
                </form>
            </div>
            <!-- Pop-up Login Modal -->
            <div id="loginModal"
                class="fixed inset-0  bg-transparent flex items-center justify-center z-50 hidden transition-opacity duration-300">
                <div class="bg-blue-900 backdrop-blur-md rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-transform duration-300 scale-95 opacity-0 border border-gray-200"
                    id="modalContent">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-white">Login Diperlukan</h3>
                            <button onclick="closeLoginModal()"
                                class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mb-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-white">Anda harus login terlebih dahulu untuk mengirim komentar.</p>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3">
                            <button onclick="closeLoginModal()"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-white hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <a href="/login"
                                class="px-4 py-2 bg-blue-600 rounded-lg text-white hover:bg-blue-700 transition-colors flex items-center">
                                Login Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Komentar -->
            <div class="w-full bg-white text-black p-6 rounded-lg shadow-lg border border-black">
                <h2 class="text-2xl font-bold mb-4">
                    Komentar ({{ $film->comments->count() }})
                </h2>

                @foreach ($film->comments->sortByDesc('created_at') as $comment)
                    <div class="testimonial-box bg-white text-black p-4 rounded-lg shadow-md border border-black mb-4">
                        <div class="box-top flex justify-between">
                            <div class="profile flex items-center">
                                <div
                                    class="profile-img w-10 h-10 rounded-full overflow-hidden border-2 border-black mr-3">
                                    <!-- Gambar profil: jika ada avatar user gunakan, jika tidak gunakan default -->
                                    @if (isset($comment->user->avatar))
                                        <img src="{{ asset($comment->user->avatar) }}"
                                            alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('icon1.jpg') }}" alt="{{ $comment->user->name }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="name-user">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span class="block text-gray-500 text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="reviews text-yellow-400 flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="client-comment mt-2 text-black">
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    @include('footer-all.footer')
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".rating input");
        const labels = document.querySelectorAll(".rating label");

        stars.forEach((star, index) => {
            star.addEventListener("change", function() {
                updateStars(index);
            });
        });

        function updateStars(selectedIndex) {
            labels.forEach((label, index) => {
                if (index <= selectedIndex) {
                    label.classList.remove("text-gray-400");
                    label.classList.add("text-yellow-400");
                } else {
                    label.classList.remove("text-yellow-400");
                    label.classList.add("text-gray-400");
                }
            });
        }
    });
</script>

<script>
    function checkLogin(event) {
        // Misalnya, cek apakah pengguna sudah login dengan kondisi ini
        const isLoggedIn = false; // Gantilah ini dengan kondisi sebenarnya

        if (!isLoggedIn) {
            event.preventDefault(); // Mencegah form untuk dikirim
            showLoginModal();
        }
    }

    function showLoginModal() {
        const modal = document.getElementById('loginModal');
        const modalContent = document.getElementById('modalContent');

        // Tampilkan modal
        modal.classList.remove('hidden');

        // Animasi fade-in
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeLoginModal() {
        const modal = document.getElementById('loginModal');
        const modalContent = document.getElementById('modalContent');

        // Animasi fade-out
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        // Tunggu animasi selesai sebelum menyembunyikan modal
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Menutup modal jika pengguna mengklik di luar konten modal
    document.getElementById('loginModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeLoginModal();
        }
    });
</script>
