<header class="bg-[#605DEC] h-16 text-white sticky top-0 left-0 w-full z-50 rounded-b-xl shadow-lg">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <div class="text-lg font-bold">Fortune Playstation</div>

        <!-- Wrapper untuk menu dan user -->
        <div class="hidden md:flex items-center space-x-6 lg:space-x-12">
            <nav class="flex space-x-6">
                <a class="hover:underline" href="#information">Informasi</a>
                <a class="hover:underline" href="{{ route('rental.index') }}">Rental</a>
            </nav>

            @if (Auth::check())
                <div class="flex items-center space-x-2 hover:underline">
                    <i class="fas fa-user"></i>
                    <a href="{{ route('account') }}">{{ Auth::user()->name }}</a>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:underline text-white px-4 py-2 rounded-lg">Masuk</a>
            @endif
        </div>

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
            <div x-show="open" x-cloak class="absolute top-16 bg-white shadow-lg rounded-lg w-48">
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Informasi</a>
                <a href="{{ route('rental.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Rental</a>
                <a href="{{ route('account') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Akun</a>
            </div>
        </div>
    </div>
</header>

<!-- Tambahkan Alpine.js jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
