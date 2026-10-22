
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin | W.D.V. Schickerling')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-navy {
            background-color: #0a192f;
        }

        .text-navy {
            color: #0a192f;
        }

        .text-gold {
            color: #c5b48c;
        }

        .bg-cream {
            background-color: #f4efd9;
        }

        .border-gold {
            border-color: #c5b48c;
        }

        .font-serif-custom {
            font-family: 'Playfair Display', serif;
        }

        .font-sans-custom {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            margin: 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
    </style>
</head>

<body class="font-sans-custom antialiased text-gray-800 bg-white">

    <!-- Header and Responsive Navigation -->
    <header
        class="bg-navy text-white border-b-2 border-gold relative z-50"
        x-data="{ mobileMenuOpen: false }"
        @keydown.escape.window="mobileMenuOpen = false"
    >
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center gap-3 py-3 sm:py-4 md:py-6">

                <!-- Logo -->
                <a href="/"
                   class="flex items-center gap-2 sm:gap-4 text-left min-w-0">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="W.D.V. Schickerling Logo"
                        class="w-10 h-10 sm:w-12 sm:h-12 md:w-16 md:h-16 rounded-full border-2 border-gold bg-white object-cover shrink-0"
                    >

                    <div class="min-w-0">
                        <h1 class="font-serif-custom text-base sm:text-xl md:text-2xl text-gold tracking-wide sm:tracking-widest leading-tight">
                            W.D.V. SCHICKERLING
                        </h1>

                        <p class="text-gold text-[9px] sm:text-xs tracking-wider sm:tracking-[0.2em] uppercase mt-1 font-medium">
                            Admin Portal
                        </p>
                    </div>
                </a>

                <!-- Desktop Account Menu -->
                <nav class="hidden md:flex items-center text-sm text-gold font-medium">
                    <div class="relative" x-data="{ accountOpen: false }">

                        <button
                            type="button"
                            @click="accountOpen = !accountOpen"
                            @click.outside="accountOpen = false"
                            :aria-expanded="accountOpen.toString()"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 hover:text-white transition"
                        >
                            <span>{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4 transition-transform"
                                 :class="{ 'rotate-180': accountOpen }"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div
                            x-cloak
                            x-show="accountOpen"
                            x-transition
                            @click.outside="accountOpen = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50 text-gray-700"
                        >
                            <a
                                href="{{ route('profile.edit') }}"
                                class="block px-4 py-3 hover:bg-gray-50 hover:text-navy transition"
                            >
                                Profile Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-3 text-red-600 hover:bg-gray-50 transition"
                                >
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>

                <!-- Mobile Menu Toggle -->
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    :aria-expanded="mobileMenuOpen.toString()"
                    aria-controls="mobile-admin-menu"
                    :aria-label="mobileMenuOpen ? 'Close navigation menu' : 'Open navigation menu'"
                    class="md:hidden flex items-center justify-center w-11 h-11 shrink-0 rounded-lg text-gold hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gold transition"
                >
                    <!-- Hamburger -->
                    <svg
                        x-cloak
                        x-show="!mobileMenuOpen"
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        ></path>
                    </svg>

                    <!-- Close -->
                    <svg
                        x-cloak
                        x-show="mobileMenuOpen"
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile Navigation Dropdown -->
        <div
            id="mobile-admin-menu"
            x-cloak
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.outside="mobileMenuOpen = false"
            class="md:hidden absolute top-full left-0 w-full bg-navy shadow-xl border-t border-white/10"
        >
            <div class="max-h-[calc(100vh-75px)] overflow-y-auto px-4 pt-4 pb-5">

                <p class="px-3 mb-3 text-xs uppercase tracking-widest text-gray-400 font-semibold">
                    Main Menu
                </p>

                <nav class="space-y-1">

                    <a
                        href="{{ route('dashboard') }}"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-3 rounded-lg transition
                        {{ request()->routeIs('dashboard') ? 'bg-cream text-navy font-semibold' : 'text-gold hover:bg-white/10 hover:text-white' }}"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('admin.meetings.index') }}"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-3 rounded-lg transition
                        {{ request()->routeIs('admin.meetings.*') ? 'bg-cream text-navy font-semibold' : 'text-gold hover:bg-white/10 hover:text-white' }}"
                    >
                        Estate Meetings
                    </a>

                    <a
                        href="{{ route('admin.properties.index') }}"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-3 rounded-lg transition
                        {{ request()->routeIs('admin.properties.*') ? 'bg-cream text-navy font-semibold' : 'text-gold hover:bg-white/10 hover:text-white' }}"
                    >
                        Properties
                    </a>

                </nav>

                <div class="my-4 border-t border-white/10"></div>

                <p class="px-3 mb-3 text-xs uppercase tracking-widest text-gray-400 font-semibold">
                    Account
                </p>

                <div class="px-3 py-2 mb-2">
                    <p class="text-xs text-gray-400">Signed in as</p>
                    <p class="text-sm text-white font-medium break-words">
                        {{ Auth::user()->name }}
                    </p>
                </div>

                <nav class="space-y-1">

                    <a
                        href="{{ route('profile.edit') }}"
                        @click="mobileMenuOpen = false"
                        class="flex items-center px-4 py-3 rounded-lg transition
                        {{ request()->routeIs('profile.*') ? 'bg-cream text-navy font-semibold' : 'text-gold hover:bg-white/10 hover:text-white' }}"
                    >
                        Profile Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="flex items-center w-full text-left px-4 py-3 rounded-lg text-red-300 hover:bg-white/10 transition"
                        >
                            Log Out
                        </button>
                    </form>

                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-w-0">
        <div class="mx-auto flex min-h-full">

            <!-- Desktop Sidebar -->
            <aside class="hidden lg:block w-64 bg-white shrink-0 shadow-sm">
                <div class="py-8 px-4 sticky top-0">

                    <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">
                        Admin Menu
                    </p>

                    <nav class="space-y-1">

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('dashboard') ? 'bg-cream text-navy border-l-4 border-gold' : 'text-gray-600 hover:bg-gray-50 hover:text-navy' }}"
                        >
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a
                            href="{{ route('admin.meetings.index') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('admin.meetings.*') ? 'bg-cream text-navy border-l-4 border-gold' : 'text-gray-600 hover:bg-gray-50 hover:text-navy' }}"
                        >
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>Estate Meetings</span>
                        </a>

                        <a
                            href="{{ route('admin.properties.index') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('admin.properties.*') ? 'bg-cream text-navy border-l-4 border-gold' : 'text-gray-600 hover:bg-gray-50 hover:text-navy' }}"
                        >
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span>Properties</span>
                        </a>

                        <div class="my-5 border-t border-gray-100"></div>

                        <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Account
                        </p>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium transition
                            {{ request()->routeIs('profile.*') ? 'bg-cream text-navy border-l-4 border-gold' : 'text-gray-600 hover:bg-gray-50 hover:text-navy' }}"
                        >
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>
                            </svg>
                            <span>Profile Settings</span>
                        </a>

                    </nav>
                </div>
            </aside>

            <!-- Page Content -->
            <div class="flex-1 w-full min-w-0 bg-white">
                {{ $slot }}
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white py-5 sm:py-6 px-4 text-center text-xs text-gray-400">
        <p>
            &copy; {{ date('Y') }} W.D.V. Schickerling Admin Portal.
            All Rights Reserved.
        </p>
    </footer>

</body>
</html>
