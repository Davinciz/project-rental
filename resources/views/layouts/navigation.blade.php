<header class="bg-[#605DEC] h-16 text-white sticky top-0 z-10 rounded-b-xl">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="text-lg font-bold">Fortune Playstation</div>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex space-x-6 lg:space-x-24">
            <a class="hover:underline" href="#">Lokasi</a>
            <a class="hover:underline" href="#">Tentang Kami</a>
            <a class="hover:underline" href="{{ route('rental.index') }}">Rental</a>
        </nav>

        <!-- Burger Menu untuk Mobile -->
        <div class="md:hidden" x-data="{ open: false }">
            <button @click="open = !open" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <!-- Mobile Menu -->
            <div x-show="open" x-cloak class="absolute top-16 right-4 bg-white shadow-lg rounded-lg w-48">
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Lokasi</a>
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Kontak</a>
                <a href="{{ route('account') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Akun</a>
            </div>
        </div>

        @if (Auth::check())
            <div class="hidden md:flex items-center space-x-2 hover:underline">
                <i class="fas fa-user"></i>
                <a href="{{ route('account') }}">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</a>
            </div>
        @else
            <a href="{{ route('login') }}" class="hover:underline text-white px-4 py-2 rounded-lg">Masuk</a>
        @endif
    </div>
</header>

<!-- Tambahkan Alpine.js jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
