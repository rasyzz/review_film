<nav class="bg-white dark:bg-blue-950 fixed top-0 left-0 w-full z-50 shadow-md p-3">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto">
        <!-- Logo -->
        <a href="{{ route('admin.home') }}" class="flex items-center">
            <img src="{{ asset('logo11.png') }}" class="h-10" alt="Logo" />
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-6">
            <ul class="flex space-x-6 text-sm text-white">
                <li>
                    <a href="{{ route('admin.home') }}#Home" class="nav-link relative hover:text-gray-400">Home</a>
                </li>
                <li>
                    <a href="{{ route('admin.home') }}#Terbaru"
                        class="nav-link relative hover:text-gray-400">Terbaru</a>
                </li>
                <li>
                    <a href="{{ route('admin.home') }}#Movies" class="nav-link relative hover:text-gray-400">Movies</a>
                </li>
                <li>
                    <a href="{{ route('admin.home') }}#Trailler"
                        class="nav-link relative hover:text-gray-400">Traillers</a>
                </li>
            </ul>

            <!-- User Dropdown Desktop -->
            <div class="relative">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="dropdownDesktopButton">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('icon1.jpg') }}" alt="user photo">
                </button>

                <!-- Dropdown Menu Desktop -->
                <div class="absolute right-0 hidden mt-2 w-48 bg-white rounded-md shadow-lg py-1 dark:bg-gray-700"
                    id="dropdownDesktop">
                    <div class="px-4 py-3">
                        <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-300">{{ Auth::user()->email }}</p>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                Profile
                            </a>
                        </li>
                        <li>
                            <button type="button" onclick="showLogoutModal()"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                Log Out
                            </button>
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white" id="mobileMenuButton">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white dark:bg-blue-950 text-white mt-2" id="mobileMenu">
        <ul class="space-y-4 p-4">
            <li>
                <a href="{{ route('admin.home') }}#Home" class="nav-link relative hover:text-gray-400 mr-5">Home</a>

                <a href="{{ route('admin.home') }}#Terbaru"
                    class="nav-link relative hover:text-gray-400 mr-5">Terbaru</a>

                <a href="{{ route('admin.home') }}#Movies"
                    class="nav-link relative hover:text-gray-400 mr-5">Movies</a>

                <a href="{{ route('admin.home') }}#Trailler"
                    class="nav-link relative hover:text-gray-400 ">Traillers</a>
            </li>
            <li class="relative pt-4">
                <button type="button" class="w-full flex items-center gap-2 text-sm bg-gray-800 rounded-full px-4 py-2"
                    id="dropdownMobileButton">
                    <img class="w-8 h-8 rounded-full" src="{{ asset('icon1.jpg') }}" alt="user photo">
                    <span>{{ Auth::user()->name }}</span>
                </button>

                <!-- Dropdown Menu Mobile -->
                <div class="hidden mt-2 w-full bg-white rounded-md shadow-lg py-1 dark:bg-gray-700" id="dropdownMobile">
                    <div class="px-4 py-3 border-b dark:border-gray-600">
                        <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-300">{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300">
                                Profile
                            </a>
                        </li>
                        <li>
                            <button type="button" onclick="showLogoutModal()"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                Log Out
                            </button>
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
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
                                <a href="{{ route('admin.film-genre', ['id' => $g->id_genre]) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-[#2E236C]">
                                    {{ $g->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <form class="w-full mx-auto" action="{{ route('admin.search') }}" method="GET">
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

<!-- Logout Confirmation Modal -->
<div id="logoutConfirmModal"
    class="fixed inset-0 bg-transparent flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-blue-950 backdrop-blur-md rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-transform duration-300 scale-95 opacity-0 border border-gray-200"
        id="logoutModalContent">
        <div class="p-6">
            <div class="mb-5">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-white">Anda yakin ingin Log Out?</p>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-white hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    Tidak
                </button>
                <button onclick="confirmLogout()"
                    class="px-4 py-2 bg-blue-600 rounded-lg text-white hover:bg-blue-700 transition-colors flex items-center">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>
{{-- LOGOUT --}}
<script>
    function showLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        const modalContent = document.getElementById('logoutModalContent');

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('bg-black', 'bg-opacity-50');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        const modalContent = document.getElementById('logoutModalContent');

        modal.classList.remove('bg-black', 'bg-opacity-50');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function confirmLogout() {
        document.getElementById('logoutForm').submit();
    }
</script>

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
</script>


<script>
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuButton.addEventListener('click', (event) => {
        mobileMenu.classList.toggle('hidden');
        event.stopPropagation(); // Mencegah event menyebar ke document
    });

    // Desktop Dropdown
    const dropdownDesktopButton = document.getElementById('dropdownDesktopButton');
    const dropdownDesktop = document.getElementById('dropdownDesktop');

    dropdownDesktopButton.addEventListener('click', (event) => {
        dropdownDesktop.classList.toggle('hidden');
        event.stopPropagation();
    });

    // Mobile Dropdown
    const dropdownMobileButton = document.getElementById('dropdownMobileButton');
    const dropdownMobile = document.getElementById('dropdownMobile');

    dropdownMobileButton.addEventListener('click', (event) => {
        dropdownMobile.classList.toggle('hidden');
        event.stopPropagation();
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdownDesktopButton.contains(event.target) && !dropdownDesktop.contains(event.target)) {
            dropdownDesktop.classList.add('hidden');
        }

        if (!dropdownMobileButton.contains(event.target) && !dropdownMobile.contains(event.target)) {
            dropdownMobile.classList.add('hidden');
        }

        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
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
