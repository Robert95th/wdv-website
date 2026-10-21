@extends('layouts.app')

@section('title', 'About Us - W.D.V. Schickerling')

@section('content')
        <section class="relative overflow-hidden h-[600px] md:h-[700px] lg:h-[800px]">
            <!-- 1. Blurry Background Layer -->
            <div class="absolute inset-0 bg-cover bg-center blur-md scale-110"
                style="background-image: url('{{ asset('images/about-bg1.jpg') }}');">
            </div>

            <div class="absolute inset-0 bg-navy/40"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 h-[600px] md:h-[700px] lg:h-[800px] flex flex-col justify-center">
                <div class="relative flex flex-col lg:flex-row items-center bg-cream overflow-hidden shadow-lg border border-gray-100 h-[600px] md:h-[600px] lg:h-[600px]">
                    <div class="w-full lg:w-1/2 z-10 p-5 md:p-16">
                        <h2 class="font-serif-custom text-4xl md:text-5xl text-navy leading-tight mb-6 p-3">
                            About the Practice
                        </h2>
                        <p class="text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
                            The practice is built on discretion, careful record-keeping, and direct, personal involvement in every estate under its administration.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#services" class="inline-block bg-navy text-white text-center font-medium px-8 py-3.5 hover:bg-gray-800 transition duration-300">
                                View Services
                            </a>
                          
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 h-64 lg:h-auto lg:absolute lg:right-0 lg:top-0 lg:bottom-0 overflow-hidden display-none md:block">

                        <img src="{{ asset('images/about-bg1.jpg') }}" alt="Office Building" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </section>
        <!-- Practice Areas Section -->
        <section class="py-16 md:py-24 bg-white w-full border-y">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center p-5">
                <h2 class="font-serif-custom text-3xl md:text-4xl text-navy mb-4">Our Expertise</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-12 text-lg">
                    Every matter is handled with the discretion, record keeping and legal precision that insolvency and estate work demands.
                </p>

          
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

                    <!-- Card 1 -->
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <!-- Icon Placeholder (SVG) -->
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Insolvency Practitioner</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Administration of insolvent estates in Liquidations and Sequestrations
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Estate Practitioner</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Deceased estates
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Receiver</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Appointment as Receiver in partnerships, universal partnerships & divorce matters </p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Special Resolution</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Voluntary Members / Creditors Winding-up by special resolution
                        </p>
                    </div>
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Administration & Restructuring</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Independent administration & restructuring of estates
                        </p>
                    </div>
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Curatorships</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Curatorships
                        </p>
                    </div>
                    <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                            <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif-custom text-xl text-navy mb-3">Cross Border Insolvency</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Cross border insolvency advice & foreign liquidator’s agent
                        </p>
                    </div>
                </div>

                <!-- Bottom Buttons -->
           
            </div>
        </section>

        <!-- About Us (Overlapping Image Layout) -->
        <section class="py-16 md:py-24 bg-cream relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative flex flex-col lg:flex-row items-center">

                    <!-- Left Image -->
                    <div class="w-full lg:w-3/5 h-80 lg:h-[500px] rounded-lg overflow-hidden shadow-xl z-10">
                        <!-- Replace with your actual image (Team photo) -->
                        <img src="{{ asset('images/about-bg2.jpg') }}" alt="W.D.V. Schickerling Team" class="w-full h-full object-cover">
                    </div>

                    <!-- Right Content Box (Overlaps on desktop) -->
                    <div class="w-full p-5 lg:w-1/2 bg-white p-10 md:p-16 lg:absolute lg:right-0 lg:top-1/2 lg:-translate-y-1/2 shadow-2xl z-20 mt-8 lg:mt-0 border-t-4 border-gold">
                        <h2 class="font-serif-custom text-3xl md:text-4xl text-navy mb-6 text-center p-5">Meet Wiam Schickerling</h2>
                        <p class="text-gray-600 mb-8 text-center leading-relaxed">
                            Wiam Schickerling holds a postgraduate qualification in Business Administration and has practised as a registered Insolvency and Estate Practitioner since 2018, administering insolvent and deceased estates and acting as receiver in partnership, universal partnership and divorce matters throughout Namibia.

                        </p>
                        <!-- <div class="flex flex-col sm:flex-row gap-4 justify-center mb-3">
                            <a href="#" class="inline-block bg-navy text-white text-center font-medium px-6 py-3 hover:bg-gray-800 transition">
                                Free Consultation
                            </a>
                            <a href="#" class="inline-block bg-transparent text-navy border border-navy text-center font-medium px-6 py-3 hover:bg-navy hover:text-white transition">
                                Learn More
                            </a>
                        </div> -->
                    </div>

                </div>
            </div>
        </section>
@endsection