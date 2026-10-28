<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Dynamic Page Title -->
    <title>@yield('title', 'W.D.V. Schickerling | Insolvency & Estate Practitioners Namibia')</title>
    <meta name="description" content="@yield('meta_description', 'Registered Insolvency and Estate Practitioners in Namibia. Specializing in liquidations, sequestration, deceased estates, and trusteeship.')">
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
    <header class="bg-navy text-white border-b-2 border-gold relative z-50" x-data="{ mobileMenuOpen: false }">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 md:py-8 gap-4">

                <!-- Logo & Brand -->
                <a href="/" class="flex flex-row items-center gap-3 sm:gap-6 text-left group shrink-0  md:w-2/3 justify-between">

                    <!-- Logo: Small on mobile, HUGE on desktop -->
                    <img src="{{ asset('images/logo.png') }}" alt="W.D.V. Schickerling Logo"
                        class="w-16 h-16 sm:w-48 sm:h-48 rounded-full border-2 border-gold bg-white object-cover shrink-0 group-hover:opacity-90 transition">

                    <!-- Text Block: Added text-center here -->
                    <div class="flex flex-col justify-center text-center">
                        <!-- W.D.V. Initials -->
                        <div class="font-serif-custom text-xl sm:text-6xl text-gold tracking-widest sm:tracking-wider leading-tight">
                            W.D.V.
                        </div>
                        <!-- Surname -->
                        <div class="font-serif-custom text-xl sm:text-6xl text-gold tracking-widest sm:tracking-wider leading-tight">
                            SCHICKERLING
                        </div>
                        <!-- Sub-header -->
                        <p class="text-gold text-[8px] sm:text-sm tracking-[0.15em] sm:tracking-[0.25em] uppercase mt-1 sm:mt-2 font-medium">
                            Insolvency & Estate Practitioners
                        </p>
                    </div>
                </a>

                <!-- Desktop Navigation (Hidden on Mobile) -->
                <nav class="hidden md:block border-l border-gray-700 pl-8 shrink-0">
                    <ul class="flex flex-col gap-3 text-sm text-gold font-medium">
                        <li><a href="/" class="{{ request()->is('/') ? 'text-white' : 'hover:text-white' }} transition uppercase">Home</a></li>
                        <li><a href="/about" class="{{ request()->is('about') ? 'text-white' : 'hover:text-white' }} transition uppercase">About</a></li>
                        <li><a href="/services" class="{{ request()->is('services') ? 'text-white' : 'hover:text-white' }} transition uppercase">Services</a></li>
                        <li><a href="/meetings" class="{{ request()->is('meetings*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Events and Actions</a></li>
                        <li><a href="/documents" class="{{ request()->is('documents*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Active Files</a></li>
                        <li><a href="/properties" class="{{ request()->is('properties*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Property for Sale</a></li>
                        <li><a href="/archived" class="{{ request()->is('archived*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Archived Files</a></li>
                    </ul>
                </nav>

                <!-- Mobile Hamburger Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gold hover:text-white focus:outline-none p-2 shrink-0" aria-label="Toggle navigation menu">
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
                <li><a href="/" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Home</a></li>
                <li><a href="/about" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">About</a></li>
                <li><a href="/services" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Services</a></li>
                <li><a href="/meetings" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Events and Actions</a></li>
                <li><a href="/documents" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Active Files</a></li>
                <li><a href="/properties" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Property for Sale</a></li>
                <li><a href="/archived" class="block px-4 py-3 rounded hover:bg-gray-800 hover:text-white transition uppercase">Archived Files</a></li>
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

                    <h3 class="font-serif-custom text-3xl text-gold mb-2">Quick Links</h3>
                    <div class="flex flex-wrap justify-between items-center mb-6">


                        <ul class="space-y-4 text-gray-300 font-medium p-3">
                            <li><a href="/" class="{{ request()->is('/') ? 'text-white' : 'hover:text-white' }} transition uppercase">Home</a></li>
                            <li><a href="/about" class="{{ request()->is('about') ? 'text-white' : 'hover:text-white' }} transition uppercase">About</a></li>
                            <li><a href="/services" class="{{ request()->is('services') ? 'text-white' : 'hover:text-white' }} transition uppercase">Services</a></li>
                            <li><a href="/meetings" class="{{ request()->is('meetings*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Events and Actions</a></li>
                            <li><a href="/documents" class="{{ request()->is('documents*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Active Files</a></li>

                            <li><a href="/properties" class="{{ request()->is('properties*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Property for Sale</a></li>
                            <li><a href="/archived" class="{{ request()->is('archived*') ? 'text-white' : 'hover:text-white' }} transition uppercase">Archived Files</a></li>
                        </ul>


                    </div>

                </div>

                <!-- Column 2: Newsletter Form -->
                <div class="text-left px-4">

                    <!-- Action Button -->
                    <a href="https://wa.me/264811432630?text=Hello%20W.D.V.%20Schickerling,%20I%20would%20like%20to%20inquire%20about%20your%20services." class="inline-flex items-center justify-center md:justify-start text-lg font-medium text-white hover:text-[#b8935a] mb-8 transition group">
                        CONTACT US
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
                        <!-- Physical Address -->
                        <div class="flex items-start justify-center md:justify-start gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-[#b8935a] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <!-- Added Google Maps Link here -->
                            <a href="https://www.google.com/maps/place/22%C2%B035'03.0%22S+17%C2%B005'37.2%22E/@-22.5841618,17.0910874,17z/data=!3m1!4b1!4m4!3m3!8m2!3d-22.5841618!4d17.0936623?hl=en&entry=ttu&g_ep=EgoyMDI2MTAyMC4wIKXMDSoASAFQAw%3D%3D"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="leading-relaxed hover:text-[#b8935a] transition-colors duration-200">
                                Unit 402, Fourth Floor<br>
                                Maerua Mall<br>
                                Windhoek<br>
                                Namibia
                            </a>
                        </div>
                        <div class="flex items-start justify-center md:justify-start gap-3 text-gray-300">
                            <!-- Mailbox/Envelope Icon -->
                            <svg class="w-5 h-5 text-[#b8935a] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="leading-relaxed">
                                P.O. Box 80981<br>
                                Windhoek<br>
                                Namibia
                            </span>
                        </div>
                    </div>



                </div>

                <!-- Column 3: Contact Details -->
                <div class="flex flex-col  md:border-l border-gray-700 md:pl-8  md:text-left    items-center justify-center text-center w-full md:w-auto p-4">
                    <a href="/" class="flex flex-col items-center group">
                        <!-- Logo Image -->
                        <img src="{{ asset('images/logo.png') }}"
                            alt="W.D.V. Schickerling Logo"
                            class="w-48 h-48 rounded-full border-2 border-gold bg-white object-cover shrink-0 group-hover:opacity-90 transition">

                        <!-- Text Container -->
                        <div class="mt-4 flex flex-col items-center">
                            <h1 class="font-serif-custom text-xl md:text-4xl text-gold tracking-widest leading-none text-center">
                                W.D.V.
                            </h1>
                            <h1 class="font-serif-custom text-xl md:text-4xl text-gold tracking-widest leading-none text-center mt-1">
                                SCHICKERLING
                            </h1>
                            <p class="text-gold text-[8px] md:text-xs tracking-[0.2em] uppercase mt-2 md:mt-3 font-medium text-center">
                                Insolvency & Estate Practitioners
                            </p>
                        </div>
                    </a>
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
    @verbatim
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LegalService",
            "name": "W.D.V. Schickerling",
            "description": "Registered Insolvency and Estate Practitioner rendering professional services across Namibia in liquidations, sequestration, and deceased estates.",
            "url": "{{ url('/') }}",
            "telephone": "+264811442959",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Unit 402, Fourth Floor, Maerua Mall",
                "addressLocality": "Windhoek",
                "addressCountry": "NA"
            },
            "areaServed": "Namibia",
            "knowsAbout": ["Insolvency", "Liquidation", "Trustee", "Receiver", "Estate Administration"]
        }
    </script>
    @endverbatim
</body>

</html>