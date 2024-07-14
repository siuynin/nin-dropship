<header>
    <!-- Topbar -->
    <div class="bg-gray-800 text-white text-center p-2">
        Welcome to our store!
    </div>
    
    <!-- Main Header -->
    <div class="flex justify-between items-center p-4 bg-white shadow">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ url('/') }}">
                <img src="/path/to/logo.png" alt="{{ config('app.name', 'Laravel') }}" class="h-8">
            </a>
        </div>

        <!-- Search Form -->
        <div class="flex-grow mx-4">
            <form action="#" method="GET" class="relative">
                <input type="text" name="query" placeholder="Search..." class="w-full border border-gray-300 rounded px-4 py-2">
                <button type="submit" class="absolute right-2 top-2 text-gray-500">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Icons -->
        <div class="flex items-center space-x-4">
            <!-- Cart Icon -->
            <a href="#" class="text-gray-700">
                <i class="fas fa-shopping-cart"></i>
            </a>

            <!-- Language Switcher -->
            <div class="relative">
                <button id="language-button" class="text-gray-700 focus:outline-none">
                    <i class="fas fa-globe"></i>
                </button>
                <div id="language-menu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                    <a href="?lang=en" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">English</a>
                    <a href="?lang=vi" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Vietnamese</a>
                </div>
            </div>

            <!-- User Auth -->
            @guest
                <a href="{{ route('login') }}" class="text-gray-700">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700">Register</a>
            @else
                <div class="relative">
                    <button id="user-button" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-user"></i>
                    </button>
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded shadow-md">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-gray-900">
        <div class="container mx-auto">
            <ul class="flex space-x-4 p-4">
                <li><a href="{{ url('/') }}" class="text-white hover:text-gray-300">Home</a></li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-gray-300">Products</a>
                    <div class="hidden group-hover:block absolute bg-white border border-gray-300 rounded shadow-md">
                        <a href=" " class="block px-4 py-2 text-gray-700 hover:bg-gray-100">All Products</a>
                        <a href=" " class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Categories</a>
                    </div>
                </li>
                <!-- Add more nav items here -->
            </ul>
        </div>
    </nav>
</header>

<script>
    document.getElementById('language-button').addEventListener('click', function() {
        document.getElementById('language-menu').classList.toggle('hidden');
    });

    document.getElementById('user-button').addEventListener('click', function() {
        document.getElementById('user-menu').classList.toggle('hidden');
    });
</script>
