<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>{{ $film->title }}</title>
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
    @include('sidebar-navbar-admin.navbar')

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
                <form action="{{ route('comments.store', $film->id_film) }}" method="post" class="space-y-4">
                    @csrf
                    <!-- Rating Section -->
                    <div class="rating1 flex flex-col items-center space-y-4 mb-2">
                        <div class="rating flex flex-wrap justify-center gap-x-2 sm:gap-x-4">
                            <input type="radio" name="rating" id="star1" value="1" class="hidden">
                            <label for="star1"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star2" value="2" class="hidden">
                            <label for="star2"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star3" value="3" class="hidden">
                            <label for="star3"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star4" value="4" class="hidden">
                            <label for="star4"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>

                            <input type="radio" name="rating" id="star5" value="5" class="hidden">
                            <label for="star5"
                                class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl">&#9733;</label>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Komentar :</h2>
                    <!-- Komentar Section -->
                    <textarea name="komentar" placeholder="Tulis komentar Anda..." required
                        class="w-full p-2 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                    <!-- Submit Button -->
                    @if (auth()->check() &&
                            $film->comments()->where('id_user', auth()->id())->exists())
                        <p class="text-red-500 font-semibold">Anda sudah berkomentar</p>
                    @else
                        <button type="submit"
                            class="bg-white border border-black text-blue-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                            Kirim
                        </button>
                    @endif

                </form>

            </div>

            <!-- Daftar Komentar -->
            <div class="w-full bg-white text-black p-6 rounded-lg shadow-lg border border-black">
                <h2 class="text-2xl font-bold mb-4">
                    Komentar ({{ $film->comments->count() }})
                </h2>

                @php
                    // Pisahkan komentar user yang sedang login dan komentar user lainnya
                    $userComments = $film->comments->filter(function ($comment) {
                        return Auth::check() && Auth::id() == $comment->user->id;
                    });

                    // Komentar dari user lain diurutkan dari yang terbaru
                    $otherComments = $film->comments
                        ->filter(function ($comment) {
                            return !Auth::check() || Auth::id() != $comment->user->id;
                        })
                        ->sortByDesc('created_at');

                    // Gabungkan kedua koleksi
                    $sortedComments = $userComments->merge($otherComments);
                @endphp

                @foreach ($sortedComments as $comment)
                    <div class="testimonial-box bg-white text-black p-4 rounded-lg shadow-md border border-black mb-4">
                        @if (Auth::check() && Auth::id() == $comment->user->id)
                            <div class="bg-blue-50 p-2 rounded-t-lg -mt-4 -mx-4 mb-2 border-b border-blue-100">
                                <span class="text-blue-600 font-medium text-sm">Komentar Anda</span>
                            </div>
                        @endif
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
                        @if (Auth::check() && Auth::id() == $comment->user->id)
                            <div class="mt-2 flex space-x-2">
                                <!-- Tombol Edit Komentar -->
                                <a href="#" class="edit-comment-link"
                                    data-comment-id="{{ $comment->id_comments }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Modal Popup untuk Edit Komentar -->
                                <div id="editModal-{{ $comment->id_comments }}"
                                    class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                    <!-- Overlay transparan -->
                                    <div class="absolute inset-0 bg-black opacity-50"></div>

                                    <!-- Konten Modal -->
                                    <div class="relative bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-lg z-10">
                                        <!-- Tombol Close -->
                                        <button type="button"
                                            class="absolute top-0 right-0 m-2 text-gray-500 hover:text-gray-700 close-modal">
                                            &times;
                                        </button>
                                        <h2 class="text-lg font-semibold mb-4">Edit Komentar</h2>
                                        <form method="POST"
                                            action="{{ route('comments.update', $comment->id_comments) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4 flex flex-col items-center space-y-4">
                                                <label for="rating"
                                                    class="block text-sm font-medium text-gray-700">Rating</label>
                                                <div class="rating flex flex-wrap justify-center gap-x-2 sm:gap-x-4">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio" name="rating"
                                                            id="star-{{ $comment->id_comments }}-{{ $i }}"
                                                            value="{{ $i }}" class="hidden"
                                                            {{ $comment->rating == $i ? 'checked' : '' }}>
                                                        <label
                                                            for="star-{{ $comment->id_comments }}-{{ $i }}"
                                                            class="cursor-pointer text-gray-400 text-4xl sm:text-6xl md:text-7xl transition-colors"
                                                            data-value="{{ $i }}">&#9733;</label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="komentar-{{ $comment->id_comments }}"
                                                    class="block text-sm font-medium text-gray-700">Komentar</label>
                                                <textarea id="komentar-{{ $comment->id_comments }}" name="komentar" rows="3"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('komentar', $comment->comment) }}</textarea>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="button"
                                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 close-modal">Batal</button>
                                                <button type="submit"
                                                    class="bg-blue-600 text-white px-4 py-2 rounded">Perbarui</button>
                                            </div>
                                        </form>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.querySelectorAll('.rating input[type="radio"]').forEach(input => {
                                                    input.addEventListener('change', function() {
                                                        let selectedValue = this.value;
                                                        let labels = this.closest('.rating').querySelectorAll('label');

                                                        labels.forEach(label => {
                                                            let labelValue = label.getAttribute('data-value');
                                                            if (labelValue <= selectedValue) {
                                                                label.classList.remove('text-gray-400');
                                                                label.classList.add('text-yellow-400');
                                                            } else {
                                                                label.classList.remove('text-yellow-400');
                                                                label.classList.add('text-gray-400');
                                                            }
                                                        });
                                                    });
                                                });

                                                // Auto select stars based on existing rating
                                                let checkedInput = document.querySelector('.rating input[type="radio"]:checked');
                                                if (checkedInput) {
                                                    checkedInput.dispatchEvent(new Event('change'));
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>

                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                    onsubmit="return confirm('Anda yakin ingin menghapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-black hover:text-gray-700 text-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Script JavaScript untuk Meng-handle Popup Modal -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Saat ikon edit diklik, tampilkan modal yang sesuai
                    document.querySelectorAll('.edit-comment-link').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();
                            const commentId = this.getAttribute('data-comment-id');
                            const modal = document.getElementById('editModal-' + commentId);
                            if (modal) {
                                modal.classList.remove('hidden');
                            }
                        });
                    });

                    // Tombol close pada modal (baik tombol "x" maupun tombol "Batal")
                    document.querySelectorAll('.close-modal').forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            // Cari elemen modal terdekat dan sembunyikan
                            const modal = this.closest('.fixed');
                            modal.classList.add('hidden');
                        });
                    });

                    // Opsional: Menutup modal ketika klik di luar konten modal
                    document.querySelectorAll('.fixed').forEach(modal => {
                        modal.addEventListener('click', function(e) {
                            if (e.target === modal) {
                                modal.classList.add('hidden');
                            }
                        });
                    });
                });
            </script>

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
