<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-jet-nav-link href="{{ route('products') }}" :active="request()->routeIs('products')">
                                Products
                            </x-jet-nav-link>

                            @auth
                            <x-jet-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-jet-nav-link>

                            <x-jet-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logoutForm').submit();">
                                {{ __('Logout') }}
                            </x-jet-nav-link>

                            <form class="hidden" method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                            </form>

                            @else
                            <x-jet-nav-link href="/login" :active="request()->routeIs('login')">
                                Login
                            </x-jet-nav-link>
                            <x-jet-nav-link href="/register" :active="request()->routeIs('register')">
                                Register
                            </x-jet-nav-link>
                            @endif
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="/" :active="request()->routeIs('products')">
                        Products
                    </x-jet-responsive-nav-link>
                    @auth
                    <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-jet-responsive-nav-link>
                    </form>
                    @else
                    <x-jet-responsive-nav-link href="/login" :active="request()->routeIs('login')">
                        Login
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="/register" :active="request()->routeIs('register')">
                        Register
                    </x-jet-responsive-nav-link>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>