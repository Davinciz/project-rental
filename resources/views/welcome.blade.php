<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Landing
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <header class="bg-[#605DEC] h-16 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="text-lg font-bold">
                Logo
            </div>
            <nav class="hidden md:flex space-x-6 lg:space-x-24">
                <a class="hover:underline" href="#">
                    Lokasi
                </a>
                <a class="hover:underline" href="#">
                    Tentang Kami
                </a>
                <a class="hover:underline" href="#">
                    Rental
                </a>
            </nav>
            <div class="flex items-center space-x-2">
                <i class="fas fa-user">
                </i>
                <span>
                    User
                </span>
            </div>
        </div>
    </header>
    <main class="relative">
        <img alt="Two people holding game controllers, one with a black controller and the other with a white controller"
            class="w-full h-auto object-cover" height="1080" src="{{ asset('image/landing 1.png') }}" width="1920" />
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-white text-center p-6">
                <h1 class="text-2xl md:text-4xl font-bold mb-4">
                    Selamat Datang, User
                </h1>
                <p class="mb-6">
                    Rasakan serunya bermain Playstation dirumah bersama teman atau keluarga
                </p>
                <a class="bg-[#605DEC] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
                    href="#">
                    <span>
                        Rental Disini
                    </span>
                    <i class="fas fa-arrow-right ml-2">
                    </i>
                </a>
            </div>
        </div>
    </main>
    <!-- Playstation Section -->
    <div class="px-6 md:px-24">
        <h2 class="text-2xl font-bold mt-16">
            Playstation
        </h2>
        <p class="text-gray-600 mb-10">
            Pilih console yang kamu suka
            <br />
            dan cobalah berbagai game
            <br />
            dengan genre yang beragam
        </p>
    </div>
    <section class="bg-[#DEDDEB] bg-opacity-50 py-10">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20">
                <!-- Playstation 3 -->
                <div class="bg-[#B8B7E3] bg-opacity-45 mx-auto flex w-[350px] md:w-[400px] flex-col rounded-lg shadow-md p-5">
                    <img alt="Playstation 3 console" class="mb-4 mx-auto" height="250" src="{{ asset('image/ps-3 2.png') }}"
                        width="250" />
                    <h3 class="text-xl font-semibold ml-5">
                        Playstation 3
                    </h3>
                    <div class="flex justify-between w-full ml-5 mt-2">
                        <div class="text-gray-600">
                            Harga
                        </div>
                        <div class="text-md font-bold mr-5">
                            Rp 90.000 /Hari
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 space-x-2">
                        <img alt="The Last of Us logo" class="h-16" height="70"
                        src="{{ asset('image/tlou 1.png') }}" width="60" />
                        <img alt="Resident Evil logo" class="h-16" height="70" src="{{ asset('image/re 1.png') }}"
                            width="60" />
                        <img alt="Assassin's Creed logo" class="h-16" height="70"
                        src="{{ asset('image/ac 1.png') }}" width="60" />
                        <img alt="Red Dead Redemption logo" class="h-16" height="70"
                            src="{{ asset('image/rdr 1.png') }}" width="60" />
                        <img alt="Grand Theft Auto logo" class="h-16" height="70"
                            src="{{ asset('image/gta 1.png') }}" width="60" />
                    </div>
                </div>
                <!-- Playstation 4 -->
                <div class="bg-[#B8B7E3] bg-opacity-45 w-[350px] md:w-[400px] mx-auto flex flex-col rounded-lg shadow-md p-5">
                    <img alt="Playstation 4 console" class="mb-4 mx-auto" height="180" src="{{ asset('image/ps-4 3.png') }}"
                        width="180" />
                    <h3 class="text-xl font-semibold">
                        Playstation 4
                    </h3>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-gray-600">
                            Harga
                        </div>
                        <div class="text-md font-bold">
                            Rp 115.000 /Hari
                        </div>
                    </div>
                    <div class="flex justify-center mt-4 space-x-2">
                        <img alt="Sekiro logo" class="h-8" height="90" src="{{ asset('image/sekiro 1.png') }}"
                            width="90" />
                        <img alt="The Last of Us Part II logo" class="h-8" height="90"
                            src="{{ asset('image/tlou 1.png') }}" width="90" />
                        <img alt="Ghost of Tsushima logo" class="h-8" height="90"
                            src="{{ asset('image/ghost 1.png') }}" width="90" />
                        <img alt="Mortal Kombat 11" class="h-8" height="90"
                            src="{{ asset('image/mk11 1.png') }}" width="90" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Television Section -->
    <div class="px-6 md:px-24">
        <h2 class="text-2xl font-bold mt-16">
            Televisi
        </h2>
        <p class="text-gray-600 mb-10">
            Kami juga menyediakan rental Televisi
            <br />
            agar pengalaman bermain kalian
            <br />
            berasa lebih puas
        </p>
    </div>
    <section class="bg-[#DEDDEB] bg-opacity-50 py-10">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-10">
                <!-- TCL 43A8 4K UHD -->
                <div class="bg-[#B8B7E3] bg-opacity-45 w-[350px] md:w-[400px] mx-auto flex flex-col rounded-lg shadow-md p-5">
                    <img alt="TCL 43A8 4K UHD" class="mb-4 mx-auto" height="180" src="{{ asset('image/tcl 1.png') }}"
                        width="180" />
                    <h3 class="text-xl font-semibold">
                        TCL 43A8 4K UHD
                    </h3>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-gray-600 font-semibold">
                            Spesifikasi
                        </div>
                        <div class="text-md font-bold">
                            Rp 60.000 /Hari
                        </div>
                    </div>
                    <p class="mt-4 text-center">
                        Flat LED Screen, 43 inch, 3840x2160 pixel, UHD.
                        <br />
                        1145 x 133 x 665 mm
                    </p>
                </div>
                <!-- COOCAA 50S6G Pro -->
                <div class="bg-[#B8B7E3] bg-opacity-45 w-[350px] md:w-[400px] mx-auto flex flex-col rounded-lg shadow-md p-5">
                    <img alt="COOCAA 50S6G Pro" class="mb-4 mx-auto" height="180"
                        src="{{ asset('image/image 2.png') }}" width="180" />
                    <h3 class="text-xl font-semibold">
                        COOCAA 50S6G Pro
                    </h3>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-gray-600 font-semibold">
                            Spesifikasi
                        </div>
                        <div class="text-md font-bold">
                            Rp 75.000 /Hari
                        </div>
                    </div>
                    <p class="mt-4 text-center">
                        50 inch LED screen with 3840x2160 pixel UHD.
                        <br />
                        Panel Frameless design
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-gray-100 p-8 md:w-1/3">
        <h2 class="text-2xl font-bold mb-4">
                <div class="flex flex-col md:flex-row gap-10 md:gap-96 px-6 md:px-24 py-10">
                Ketentuan
            </h2>
            <p class="mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                <br />
                Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
            </p>
            <h2 class="text-2xl font-bold mb-4">
                Tentang Kami
            </h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac
                aliquet odio mattis.
            </p>
        </div>
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4">
                Kontak
            </h2>
        </div>
    </div>
    <footer class="bg-blue-600 text-white p-8 mt-8">
        <div class="flex flex-col md:flex-row justify-between gap-10 md:gap-52 px-6 md:px-24">
            <div class="mb-8 md:mb-0">
                <h2 class="text-xl font-bold mb-4">
                    Logo
                </h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <br />
                    Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
                </p>
            </div>
            <div class="flex flex-col md:flex-row gap-10">
                <div class="mb-8 md:mb-0">
                    <h2 class="text-xl font-bold mb-4">
                        COMPANY
                    </h2>
                    <ul>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                About us
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Contact
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Careers
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-xl font-bold mb-4">
                        SHOP
                    </h2>
                    <ul>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                My Account
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Checkout
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Cart
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
