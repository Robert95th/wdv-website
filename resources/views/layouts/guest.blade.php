<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .bg-navy { background-color: #0a192f; }
            .text-navy { color: #0a192f; }
            .text-gold { color: #c5b48c; }
            .bg-cream { background-color: #f4efd9; }
            .border-gold { border-color: #c5b48c; }
            .font-serif-custom { font-family: 'Playfair Display', serif; }
            .font-sans-custom { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans-custom text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
            
            <div class="w-full sm:max-w-5xl mt-6 px-6 py-4 bg-white shadow-2xl overflow-hidden sm:rounded-lg flex flex-col md:flex-row border-t-4 border-gold">
                
                <!-- Left Side: Brand / Info -->
                <div class="hidden md:flex md:w-1/2 bg-navy p-10 flex-col justify-center relative overflow-hidden">
                    <!-- Background Blur -->
                    <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('{{ asset('images/about-bg1.jpg') }}');"></div>
                    
                    <div class="relative z-10 text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24 mx-auto rounded-full border-2 border-gold mb-6 bg-white object-cover">
                        <h1 class="font-serif-custom text-3xl text-gold tracking-widest leading-tight mb-2">
                            W.D.V.<br>SCHICKERLING
                        </h1>
                        <p class="text-gold text-xs tracking-[0.2em] uppercase">Insolvency & Estate Practitioners</p>
                        
                        <div class="mt-10 border-t border-gray-700 pt-6">
                            <p class="text-gray-300 text-sm italic leading-relaxed">
                                "Steady hands for insolvent and deceased estates."
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side: The Form Slot -->
                <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center">
                    {{ $slot }}
                </div>
            </div>

            <!-- Back to Home Link -->
            <div class="mt-8 mb-4">
                <a href="/" class="text-sm text-gray-500 hover:text-navy transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to main site
                </a>
            </div>
        </div>
    </body>
</html>