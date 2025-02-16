<section class="w-full md:w-3/4 md:ml-4">
    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
        <div class="flex items-center mb-4">
            <i class="fas fa-user mr-2">
            </i>
            <span class="font-bold">
                Profile
            </span>
        </div>
        <div class="text-gray-700">
            <p>
                Username : {{ Auth::check() ? Auth::user()->name : 'Guest' }}
            </p>
            <p>
                Email : {{ Auth::check() ? Auth::user()->email : 'Guest' }}
            </p>
            <p>
                Nomor : {{ Auth::check() ? Auth::user()->phone : 'Guest' }}
            </p>
            <p>
                Password : ********
            </p>
        </div>
    </div>