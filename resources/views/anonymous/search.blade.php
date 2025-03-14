<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-900">
    @include('navbar-anonymous.navbar')
    <div class="flex items-center justify-between mt-35 md:mt-40 bg-gray-900">
        <h2 class="text-2xl text-left ml-3 md:ml-8 text-white font-bold inline-block bg-blue-950 rounded-lg p-2">
            Hasil Pencarian:
        </h2>
    </div>
    <div
        class="container-2 bg-gray-900 p-4 md:p-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-5 justify-center">
        @foreach ($film as $item)
            <div class="card relative w-full h-56 sm:h-64 md:h-72 rounded-lg overflow-hidden shadow-lg">
                <div class="card-content-wrapper h-full">
                    @if ($item->poster)
                        <a href="{{ route('detail.film', $item->id_film) }}">
                            <div class="relative w-full h-full">
                                <img src="{{ asset('storage/' . $item->poster) }}" alt="card1"
                                    class="card-image w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-110">
                                <!-- Gradasi hitam pada bagian bawah gambar -->
                                <div
                                    class="absolute bottom-0 left-0 w-full h-1/3 bg-gradient-to-t from-black to-transparent">
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-800">
                            <span class="text-white text-xs sm:text-sm">No Image</span>
                        </div>
                    @endif
                </div>
                <div
                    class="rating absolute top-2 right-2 bg-yellow-400/30 text-black text-xs font-bold px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-lg shadow">
                    ⭐ {{ number_format($item->comments->avg('rating') ?: 0, 1) }}
                </div>
                <div class="card-title-wrapper absolute bottom-0 w-full p-1 sm:p-2 text-center text-white">
                    <h5 class="card-title text-xs font-bold truncate">{{ $item->title }} ({{ $item->release_year }})
                    </h5>
                </div>
            </div>
        @endforeach
    </div>

    @empty($film)
        <p class="text-gray-500">Film tidak ditemukan.</p>
        @endforelse


        @include('footer-all.footer')
    </body>

    </html>
