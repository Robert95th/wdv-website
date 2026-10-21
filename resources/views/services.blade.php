@extends('layouts.app')

@section('title', 'Services - W.D.V. Schickerling')


@section('content')
<section class="relative overflow-hidden h-[600px] md:h-[700px] lg:h-[500px]">
    <!-- 1. Blurry Background Layer -->
    <div class="absolute inset-0 bg-cover bg-center blur-md scale-110"
        style="background-image: url('{{ asset('images/about-bg1.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-navy/40"></div>
    <div class="relative z-10 max-w-2xl mx-auto px-8 py-12  flex flex-col justify-center">
        <div class="relative flex flex-col lg:flex-row items-center bg-cream overflow-hidden shadow-lg border border-gray-100 ">
         
                <h2 class="font-serif-custom text-4xl md:text-5xl text-navy leading-tight mb-6 p-3">
                    About the Practice
                </h2>
                <p class="text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
                    The practice is built on discretion, careful record keeping, and direct, personal involvement in every estate under its administration.
                </p>
    
           
        </div>
    </div>
</section>
<section id="services" class="py-16 md:py-24 bg-white w-full border-y" x-data="{ openModal: false, selectedService: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center p-5">

        <div class="">

            <h2 class="font-serif-custom text-3xl md:text-4xl text-navy mb-4">Our Expertise</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12 text-lg">
                Every matter is handled with the discretion, record keeping and legal precision that insolvency and estate work demands.
            </p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

            <!-- Card 1 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Insolvency Practitioner</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Administration of insolvent estates in Liquidations and Sequestrations.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Insolvency Practitioner'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 2 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Estate Practitioner</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Deceased estates.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Estate Practitioner'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Receiver</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Appointment as Receiver in partnerships, universal partnerships & divorce matters.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Receiver'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 4 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Special Resolution</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Voluntary Members / Creditors Winding-up by special resolution.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Special Resolution'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 5 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Administration & Restructuring</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Independent administration & restructuring of estates.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Administration & Restructuring'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 6 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Curatorships</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Appointment and ongoing administration of curatorships.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Curatorships'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>

            <!-- Card 7 -->
            <div class="bg-white border border-gray-200 p-8 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center mb-6 border border-gold">
                        <svg class="w-6 h-6 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-serif-custom text-xl text-navy mb-3">Cross Border Insolvency</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Cross border insolvency advice & foreign liquidator’s agent.
                    </p>
                </div>
                <button @click="openModal = true; selectedService = 'Cross Border Insolvency'" class="w-full bg-navy text-white text-center font-medium px-6 py-2.5 hover:bg-gray-800 transition duration-300">
                    Request Service
                </button>
            </div>
        </div>

   
    </div>

    <!-- THE MODAL FORM -->
    <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="openModal = false"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <div class="bg-navy px-4 py-5 sm:px-6 border-b-2 border-gold">
                    <h3 class="text-lg leading-6 font-serif-custom text-gold" id="modal-title">Request Service: <span x-text="selectedService"></span></h3>
                </div>

                <!-- Form -->
                <form action="#" method="POST" class="px-4 py-5 sm:p-6 space-y-4">
                    @csrf
                    <!-- Hidden input to capture which service was clicked -->
                    <input type="hidden" name="service" x-model="selectedService">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" required class="mt-1 block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" required class="mt-1 block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone" required class="mt-1 block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Brief description of your matter</label>
                        <textarea name="message" rows="3" required class="mt-1 block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2 border"></textarea>
                    </div>

                    <div class="bg-cream p-4 text-sm text-gray-700 border border-gold/30">
                        <strong>What to bring:</strong> After submitting, we will contact you to arrange a consultation. Please bring your ID, full list of assets/liabilities, and relevant court documents or financial statements.
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="submit" class="inline-flex w-full justify-center bg-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 sm:col-start-2">Submit Request</button>
                        <button type="button" @click="openModal = false" class="mt-3 inline-flex w-full justify-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection