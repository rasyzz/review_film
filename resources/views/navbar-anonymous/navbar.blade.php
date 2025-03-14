<nav class="bg-white dark:bg-blue-950 fixed top-0 left-0 w-full z-50 shadow-md p-3">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto">
        <div class="flex items-center space-x-6">
            <!-- Logo -->
            <a href="{{ route('anonymous') }}" class="flex items-center">
                <img src="{{ asset('logo11.png') }}" class="h-10" alt="Logo" />
            </a>
        </div>

        <!-- Menu (hidden on small screens) -->
        <ul class="hidden md:flex space-x-6 text-sm ml-auto text-white">
            <li>
                <a href="{{ route('anonymous') }}#Home" class="nav-link relative hover:text-gray-400">Home</a>
            </li>
            <li>
                <a href="{{ route('anonymous') }}#Terbaru" class="nav-link relative hover:text-gray-400">Terbaru</a>
            </li>
            <li>
                <a href="{{ route('anonymous') }}#Movies" class="nav-link relative hover:text-gray-400">Movies</a>
            </li>
            <li>
                <a href="{{ route('anonymous') }}#Trailler" class="nav-link relative hover:text-gray-400">Traillers</a>
            </li>
            <li>
                <a href="{{ route('login') }}"
                    class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition mr-4">
                    LogIn
                </a>

                <a href="{{ route('register') }}"
                    class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition">
                    Register
                </a>
            </li>
        </ul>

        <!-- Mobile menu toggle button -->
        <button class="md:hidden text-white hover:text-gray-400" id="menu-toggle">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (hidden by default, toggled on mobile) -->
    <div class="md:hidden text-white p-3 mt-3 hidden" id="mobile-menu">
        <ul class="space-y-4 text-sm">
            <li>
                <a href="{{ route('anonymous') }}#Home" class="nav-link relative hover:text-gray-400 mr-5">Home</a>

                <a href="{{ route('anonymous') }}#Terbaru"
                    class="nav-link relative hover:text-gray-400 mr-5">Terbaru</a>

                <a href="{{ route('anonymous') }}#Movies" class="nav-link relative hover:text-gray-400 mr-5">Movies</a>

                <a href="{{ route('anonymous') }}#Trailler"
                    class="nav-link relative hover:text-gray-400 ">Traillers</a>
            </li>
            <li>
                <a href="{{ route('login') }}"
                    class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition mr-3">
                    LogIn
                </a>

                <a href="{{ route('register') }}"
                    class="border border-white text-white px-3 py-1 rounded-lg hover:bg-white hover:text-black transition">
                    Register
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="search-bar absolute top-[70px] left-0 w-full p-8 pt-5 z-40">
    <div class="max-w-full mx-auto">
        <div class="relative w-full flex items-center gap-4">
            <div class="relative inline-block text-left">
                <button id="dropdownButton"
                    class="p-4 px-5 flex items-center text-white bg-blue-950 rounded-lg hover:bg-blue-900">
                    Genre
                </button>
                <div id="dropdownMenu" class="hidden absolute left-0 mt-2 w-40 bg-blue-950 text-white shadow-lg">
                    <ul class="grid grid-cols-1 gap-2 p-2 text-sm text-gray-700 dark:text-gray-200">
                        @foreach ($genre as $g)
                            <li>
                                <a href="{{ route('film-genre', ['id' => $g->id_genre]) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">
                                    {{ $g->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <form class="w-full mx-auto" action="{{ route('search') }}" method="GET">
                <div class="relative w-full ml-0">
                    <input type="text" name="search" autocomplete="off" placeholder="Search Film..."
                        class="w-full p-3 rounded-lg text-white bg-white/10 backdrop-blur-md border-4 border-blue-950 focus:outline-none focus:ring-2 focus:ring-white placeholder-white">
                    <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white ">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
<script>
    document.getElementById('dropdownButton').addEventListener('click', function(event) {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
        event.stopPropagation(); // Mencegah event dari klik button menyebar ke document
    });

    document.addEventListener('click', function(event) {
        let dropdownMenu = document.getElementById('dropdownMenu');
        let dropdownButton = document.getElementById('dropdownButton');

        // Cek apakah yang diklik bukan button atau menu
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden'); // Sembunyikan dropdown
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        // Toggle the mobile menu
        menuToggle.addEventListener("click", function() {
            mobileMenu.classList.toggle("hidden");
        });
    });
</script>


<style>
    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 2px;
        background-color: white;
        transform: scaleX(0);
        transition: transform 0.3s ease-in-out;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        transform: scaleX(1);
    }

    /* Ensure the navbar is responsive */
    @media (max-width: 768px) {
        .search-bar {
            top: 60px;
            padding: 10px;
            margin-left: 0px;
        }

        #dropdownButton {
            width: 80px;
            height: 45px;
            text: left;
        }

        #dropdownMenu {
            width: 100%;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 14px;
        }
    }
</style>
