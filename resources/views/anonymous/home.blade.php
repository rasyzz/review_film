<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rasy.id</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Rajdhani:wght@700&family=Audiowide&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>

<body class="bg-gray-900">
    @include('navbar-anonymous.navbar')
    {{-- banner --}}
    <div id="Home" class="background-overlay flex items-center justify-center mt-35">
        <div class="slider-container w-full">
            <div class="slider w-full">
                @foreach ($f1 as $item)
                    <div class="slide bg-gray-900 p-4 md:p-8 py-0">
                        <div class="content w-full text-white bg-black p-3 md:p-6 relative">
                            <div class="banner absolute inset-0 bg-cover bg-center overflow-hidden h-[300px] md:h-[448px]"
                                style="background-image: url('{{ asset('storage/' . $item->poster) }}');">
                                <div class="bg1 absolute inset-0 bg-black opacity-80"></div>
                            </div>

                            <div
                                class="container11 relative z-10 flex flex-col md:flex-row items-center justify-between min-h-[300px] md:min-h-[400px] h-auto md:h-[400px] sm:h-[50px]">
                                <div
                                    class="poster w-1/3 md:w-1/5 p-1 md:ml-5 flex items-center justify-start h-full mb-4 md:mb-0">
                                    <img src="{{ asset('storage/' . $item->poster) }}" alt="Film Poster"
                                        class="w-full h-auto rounded-lg shadow-md">
                                </div>

                                <div class="w-full md:w-2/3 p-2 md:p-5 text-center">
                                    <div
                                        class="title flex flex-col items-center text-center space-y-3 md:space-y-6 mt-3 md:mt-10">
                                        <h1 class="text-2xl md:text-4xl lg:text-6xl font-bold tracking-wider uppercase text-white drop-shadow-md mr-0 md:mr-20"
                                            style="font-family: 'Orbitron', sans-serif;">
                                            {{ $item->title }}
                                        </h1>

                                        <button
                                            class="bg-transparent border-2 border-white text-white px-3 py-1 md:px-4 md:py-2 text-sm rounded-full cursor-pointer transition duration-300 ease-in-out transform hover:bg-white hover:text-black hover:scale-105 active:scale-95 shadow-lg mr-0 md:mr-20">
                                            <a href="{{ route('detail.film', $item->id_film) }}"
                                                class="no-underline">Selengkapnya</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button
                class="prev absolute top-1/2 transform -translate-y-1/2 left-2 md:left-9 p-2 md:p-3 rounded-lg duration-300 bg-black/50 text-white border-none z-10"
                onclick="moveSlide(-1)">
                &lt;
            </button>
            <button
                class="next absolute top-1/2 transform -translate-y-1/2 right-2 md:right-9 p-2 md:p-3 rounded-lg duration-300 bg-black/50 text-white border-none z-10"
                onclick="moveSlide(1)">
                &gt;
            </button>
        </div>

        <script>
            let slideIndex = 0;
            let autoSlideInterval;
            let slider;
            let slides;
            let totalSlides;
            let isAnimating = false;

            function setupSlider() {
                slider = document.querySelector('.slider');
                slides = document.querySelectorAll('.slide');
                totalSlides = slides.length;

                // Duplikasi slide pertama di akhir dan slide terakhir di awal
                // untuk membuat ilusi transisi berputar yang mulus
                const firstSlideClone = slides[0].cloneNode(true);
                const lastSlideClone = slides[totalSlides - 1].cloneNode(true);

                slider.appendChild(firstSlideClone);
                slider.insertBefore(lastSlideClone, slides[0]);

                // Setel posisi awal ke slide pertama (bukan clone)
                slideIndex = 1;
                slider.style.transform = `translateX(-${slideIndex * 100}%)`;

                // Hilangkan transisi agar penempatan awal tidak terlihat
                slider.style.transition = 'none';
                setTimeout(() => {
                    slider.style.transition = 'transform 0.5s ease';
                }, 10);
            }

            function moveSlide(n) {
                if (isAnimating) return;
                isAnimating = true;

                // Update jumlah slide setelah penambahan clone
                slides = document.querySelectorAll('.slide');
                totalSlides = slides.length;

                slideIndex += n;
                slider.style.transform = `translateX(-${slideIndex * 100}%)`;

                // Tunggu animasi selesai
                setTimeout(() => {
                    // Jika sudah sampai di clone terakhir, lompat ke slide asli pertama
                    if (slideIndex >= totalSlides - 1) {
                        slideIndex = 1;
                        slider.style.transition = 'none';
                        slider.style.transform = `translateX(-${slideIndex * 100}%)`;
                        setTimeout(() => {
                            slider.style.transition = 'transform 0.5s ease';
                        }, 10);
                    }

                    // Jika sudah sampai di clone pertama, lompat ke slide asli terakhir
                    if (slideIndex <= 0) {
                        slideIndex = totalSlides - 2;
                        slider.style.transition = 'none';
                        slider.style.transform = `translateX(-${slideIndex * 100}%)`;
                        setTimeout(() => {
                            slider.style.transition = 'transform 0.5s ease';
                        }, 10);
                    }

                    isAnimating = false;
                }, 500); // Durasi animasi
            }

            function autoSlide() {
                autoSlideInterval = setInterval(() => {
                    moveSlide(1);
                }, 5000);
            }

            function updateSliderHeight() {
                const screenWidth = window.innerWidth;
                const slides = document.querySelectorAll('.slide');

                if (screenWidth <= 480) {
                    slides.forEach(slide => {
                        const content = slide.querySelector('.content');
                        content.style.minHeight = '250px';
                    });
                } else if (screenWidth <= 768) {
                    slides.forEach(slide => {
                        const content = slide.querySelector('.content');
                        content.style.minHeight = '300px';
                    });
                } else {
                    slides.forEach(slide => {
                        const content = slide.querySelector('.content');
                        content.style.minHeight = '400px';
                    });
                }
            }

            function pauseSlideOnHover() {
                const sliderContainer = document.querySelector('.slider-container');

                sliderContainer.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                sliderContainer.addEventListener('mouseleave', () => {
                    autoSlide();
                });
            }

            document.addEventListener("DOMContentLoaded", () => {
                setupSlider();
                autoSlide();
                updateSliderHeight();
                pauseSlideOnHover();
                window.addEventListener('resize', updateSliderHeight);
            });
        </script>
    </div>
    {{-- terbaru --}}
    <div id="Terbaru">
        <div class="flex flex-row items-center justify-between px-7 mb-3">
            <h2 class="text-xl md:text-2xl text-left text-white font-bold inline-block border-b-2 border-white p-2">
                Terbaru
            </h2>
        </div>
        <div
            class="terbaru bg-gray-900 p-7 md:p-7 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-7 justify-items-center">
            @php
                $newestFilms = $films->sortByDesc('release_year')->take(5);
            @endphp

            @foreach ($newestFilms as $item)
                <div class="card relative w-full rounded-lg overflow-hidden">
                    <div class="card-content-wrapper">
                        @if ($item->poster)
                            <a href="{{ route('detail.film', $item->id_film) }}">
                                <img src="{{ asset('storage/' . $item->poster) }}" alt="card1"
                                    class="card-image w-full h-auto transition-transform duration-300 ease-in-out hover:scale-110">
                                <div
                                    class="absolute bottom-0 left-0 w-full h-1/3 bg-gradient-to-t from-black to-transparent">
                                </div>
                            </a>
                        @else
                            <span class="text-white">No Image</span>
                        @endif
                    </div>
                    <div
                        class="rating absolute top-2 right-2 bg-yellow-400/30 text-black text-xs sm:text-sm font-bold px-2 py-1 rounded-lg shadow">
                        ⭐ {{ number_format($item->comments->avg('rating') ?: 0, 1) }}
                    </div>
                    <div class="card-title-wrapper absolute bottom-0 w-full p-2 text-center text-white">
                        <h5 class="card-title text-xs sm:text-sm font-bold">{{ $item->title }}
                            ({{ $item->release_year }})
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- movies --}}
    <div id="Movies">
        <div class="flex flex-row items-center justify-between mb-3 px-7">
            <h2 class="text-xl md:text-2xl text-left text-white font-bold inline-block border-b-2 border-white p-2">
                Movies
            </h2>

            <div class="flex space-x-4">
                <a href="{{ route('movies') }}"
                    class="bg-blue-950 text-white hover:bg-blue-800 p-2 rounded-lg text-sm md:text-base">
                    Lihat Semua →
                </a>
            </div>
        </div>

        <div class="container-2 bg-gray-900 p-7 md:p-7 grid gap-7 md:gap-7 justify-items-center">
            @foreach ($films->slice(0, 10) as $item)
                <div class="card relative w-full rounded-lg overflow-hidden">
                    <div class="card-content-wrapper">
                        @if ($item->poster)
                            <a href="{{ route('detail.film', $item->id_film) }}">
                                <img src="{{ asset('storage/' . $item->poster) }}" alt="card1"
                                    class="card-image transition-transform duration-300 ease-in-out hover:scale-110">
                                <div
                                    class="absolute bottom-0 left-0 w-full h-1/3 bg-gradient-to-t from-black to-transparent">
                                </div>
                            </a>
                        @else
                            <span class="text-white">No Image</span>
                        @endif
                    </div>
                    <div
                        class="rating absolute top-2 right-2 bg-yellow-400/30 text-black text-xs sm:text-sm font-bold px-2 py-1 rounded-lg shadow">
                        ⭐ {{ number_format($item->comments->avg('rating') ?: 0, 1) }}
                    </div>
                    <div class="card-title-wrapper absolute bottom-0 w-full p-2 text-center text-white">
                        <h5 class="card-title text-xs sm:text-sm font-bold">{{ $item->title }}
                            ({{ $item->release_year }})
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- trailler --}}
    <div id="Trailler" class="mb-8">
        <div class="flex flex-row items-center justify-between px-7 mb-4">
            <h2 class="text-xl md:text-2xl text-left text-white font-bold inline-block border-b-2 border-white p-2">
                Trailler
            </h2>

            <div class="flex space-x-4">
                <a href="{{ route('trailer') }}"
                    class="bg-blue-950 text-white hover:bg-blue-800 p-2 rounded-lg text-sm md:text-base">
                    Lihat Semua →
                </a>
            </div>
        </div>

        <div class="w-full p-2 md:p-3 mt-3 md:mt-5 bg-gray-900 h-auto mb-8">
            <div class="relative">
                <div class="swiper-container relative overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach ($films->slice(0, 6) as $item)
                            <div class="swiper-slide px-2 md:px-5">
                                <div class="bg-blue-950 rounded-lg p-2 md:p-4 shadow-lg">
                                    <div class="relative bg-black rounded-lg overflow-hidden">
                                        <video id="trailerVideo-{{ $item->id }}" controls
                                            class="w-full h-32 sm:h-40 md:h-60 object-cover rounded-lg"
                                            poster="{{ asset('storage/' . $item->poster) }}">
                                            <source src="{{ asset('storage/' . $item->trailer) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <p class="mt-2 text-center text-xs sm:text-sm font-semibold text-white truncate">
                                        {{ $item->title }} ({{ $item->release_year }})
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-between w-full p-2">
                    <button
                        class="swiper-prev ml-2 md:ml-6 mt-3 md:mt-5 px-2 py-1 md:px-4 md:py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600 text-xs md:text-base">
                        &lt; prev
                    </button>
                    <div class="swiper-pagination flex justify-center items-center"></div>
                    <button
                        class="swiper-next mr-2 md:mr-6 mt-3 md:mt-5 px-2 py-1 md:px-4 md:py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-600 text-xs md:text-base">
                        next &gt;
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 2,
            spaceBetween: 3,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-next',
                prevEl: '.swiper-prev',
            },
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                }
            },
            on: {
                init: function() {
                    setTimeout(() => {
                        this.update();
                    }, 500);
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            setupMoviesGrid();
            window.addEventListener('resize', setupMoviesGrid);
        });

        function setupMoviesGrid() {
            const container = document.querySelector('.container-2');
            const screenWidth = window.innerWidth;

            if (screenWidth <= 640) {
                container.style.gridTemplateColumns = 'repeat(2, minmax(0, 1fr))';
            } else if (screenWidth <= 768) {
                container.style.gridTemplateColumns = 'repeat(3, minmax(0, 1fr))';
            } else if (screenWidth <= 1024) {
                container.style.gridTemplateColumns = 'repeat(4, minmax(0, 1fr))';
            } else {
                container.style.gridTemplateColumns = 'repeat(5, minmax(0, 1fr))';
            }
        }
    </script>

    @include('footer-all.footer')
</body>

</html>
