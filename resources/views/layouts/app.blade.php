<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Dynamic Page Title -->
    <title>@yield('title', 'W.D.V. Schickerling')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">




    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Colors */
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

        /* Body Grid for Sticky Footer */
        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            margin: 0;
        }

        /* Footer 3-Column Grid */
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

    <!-- Header / Navigation -->
    <!-- Header / Navigation -->
    <header class="bg-navy text-white border-b-2 border-gold relative z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 md:py-8">

                <!-- Logo & Brand (Flex row on mobile too, to save space) -->
                <a href="/" class="flex flex-row items-center gap-4 text-left group">
                    <img src="{{ asset('images/logo.png') }}" alt="W.D.V. Schickerling Logo" class="w-14 h-14 md:w-24 md:h-24 rounded-full border-2 border-gold bg-white object-cover shrink-0 group-hover:opacity-90 transition">
                    <div>
                        <h1 class="font-serif-custom text-xl md:text-4xl text-gold tracking-widest leading-none">
                            W.D.V.<br class="hidden md:block"> SCHICKERLING
                        </h1>
                        <p class="text-gold text-[8px] md:text-xs tracking-[0.2em] uppercase mt-1 md:mt-2 font-medium">
                            Insolvency & Estate Practitioners
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation (Hidden on Mobile) -->
                <nav class="hidden md:block border-l border-gray-700 pl-8">
                    <ul class="flex flex-col gap-3 text-sm text-gold font-medium">
                        <li><a href="/" class="{{ request()->is('/') ? 'text-white' : 'hover:text-white' }} transition">Home</a></li>
                        <li><a href="/about" class="{{ request()->is('about') ? 'text-white' : 'hover:text-white' }} transition">About</a></li>
                        <li><a href="/services" class="{{ request()->is('services') ? 'text-white' : 'hover:text-white' }} transition">Services</a></li>
                        <li><a href="/meetings" class="{{ request()->is('meetings*') ? 'text-white' : 'hover:text-white' }} transition">Estate Meetings</a></li>
                        <li><a href="/archived" class="{{ request()->is('archived*') ? 'text-white' : 'hover:text-white' }} transition">Archived Meetings</a></li>
                        <li><a href="/properties" class="{{ request()->is('properties*') ? 'text-white' : 'hover:text-white' }} transition">Properties for Sale</a></li>
                    </ul>
                </nav>

                <!-- Mobile Hamburger Button (Visible only on Mobile) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gold hover:text-white focus:outline-none p-2">
                    <svg x-show="!mobileMenuOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" style="display: none;" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            style="display: none;"
            class="md:hidden absolute top-full left-0 w-full bg-navy border-b-2 border-gold shadow-xl">
            <ul class="px-4 pt-2 pb-6 space-y-1 text-sm font-medium text-gold">
                <li><a href="/" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">Home</a></li>
                <li><a href="/about" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">About</a></li>
                <li><a href="/services" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">Services</a></li>
                <li><a href="/meetings" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">Estate Meetings</a></li>
                <li><a href="/archived" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">Archived Meetings</a></li>
                <li><a href="/properties" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition">Properties for Sale</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Area -->
    <footer class="bg-navy text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="footer-grid mb-16">

                <!-- Column 1: Menu -->
                <div class="flex flex-col md:border-r border-gray-700 md:pr-8">
                    <div class="flex flex-wrap justify-between items-center mb-6">


                        <ul class="space-y-4 text-gray-300 font-medium">
                            <li><a href="/about" class="hover:text-gold transition">About Us</a></li>
                            <li><a href="/#services" class="hover:text-gold transition">Services</a></li>
                            <li><a href="#" class="hover:text-gold transition">Our Team</a></li>
                            <li><a href="#" class="hover:text-gold transition">Contact</a></li>
                        </ul>


                    </div>
                    <!-- Social Icons
                    <div class="flex gap-4 mt-8">
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-500 flex items-center justify-center hover:border-gold hover:text-gold transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-500 flex items-center justify-center hover:border-gold hover:text-gold transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>
                        </a>
                    </div> -->
                </div>

                <!-- Column 2: Newsletter Form -->
<div class="text-center px-4">
    <h3 class="font-serif-custom text-3xl text-gold mb-2">Get Updates</h3>
    <p class="text-sm text-gray-400 italic mb-6">Subscribe to our newsletter to receive updates and special announcements.</p>

    <!-- Success / Error Messages -->
    @if(session('success'))
        <div class="bg-green-900/50 border border-green-500 text-green-200 px-4 py-2 rounded text-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
        @csrf
        
        <!-- Honeypot Field (Hidden from users) -->
        <div class="hidden" aria-hidden="true">
            <input type="text" name="website_url" tabindex="-1" autocomplete="off">
        </div>

        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="*Email" required class="w-full bg-transparent border border-gray-500 p-3 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-gold transition">
            @error('email')
                <span class="text-red-400 text-xs text-left block mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="w-full">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="*First Name" required class="w-full bg-transparent border border-gray-500 p-3 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-gold transition">
                @error('first_name')
                    <span class="text-red-400 text-xs text-left block mt-1">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-white text-navy font-bold text-sm px-6 py-3 hover:bg-gray-200 transition whitespace-nowrap h-[46px]">
                SIGN UP
            </button>
        </div>
    </form>
</div>

                <!-- Column 3: Contact Details -->
                <div class="flex flex-col md:border-l border-gray-700 md:pl-8 text-center md:text-left">
                    <!-- Action Button -->
                    <a href="mailto:wiam@iande.co" class="inline-flex items-center justify-center md:justify-start text-lg font-medium text-white hover:text-[#b8935a] mb-8 transition group">
                        Send Us A Message
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                    <!-- Contact Details List -->
                    <div class="space-y-4">

                        <!-- Phone -->
                        <a href="tel:+264811442959" class="flex items-center justify-center md:justify-start gap-3 text-gray-300 hover:text-white transition group">
                            <svg class="w-5 h-5 text-[#b8935a] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+264 81 144 2959</span>
                        </a>

                        <!-- Email -->
                        <a href="mailto:wiam@iande.co" class="flex items-center justify-center md:justify-start gap-3 text-gray-300 hover:text-white transition group">
                            <svg class="w-5 h-5 text-[#b8935a] group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>wiam@iande.co</span>
                        </a>

                        <!-- Address -->
                        <div class="flex items-start justify-center md:justify-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-[#b8935a] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="leading-relaxed">
                                Unit 402, Fourth Floor<br>
                                Maerua Mall<br>
                                Windhoek<br>
                                Namibia
                            </span>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Footer Bottom Copyright -->
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} W.D.V. Schickerling. All Rights Reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>