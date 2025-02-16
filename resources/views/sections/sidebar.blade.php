<main class="p-4 md:p-8">
    <div class="flex flex-col md:flex-row">
        <aside class="w-full md:w-1/4 bg-white p-4 rounded-lg shadow-md mb-4 md:mb-0">
            <div class="mb-4">
                <button class="flex items-center w-full p-2 text-left text-gray-700 hover:bg-gray-200 rounded-lg">
                    <i class="fas fa-user mr-2">
                    </i>
                    <span>
                        Account Detail
                    </span>
                </button>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center w-full p-2 text-left text-gray-700 hover:bg-gray-200 rounded-lg"
                        type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout</button>
                </form>
            </div>
        </aside>
