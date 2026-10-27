@extends('layouts.app')

@section('title', 'Services | W.D.V. Schickerling')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-navy flex items-center justify-center min-h-[400px] md:min-h-[500px]">
    <!-- Background Image with darker navy overlay for contrast -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/about-bg1.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-30 blur-md scale-110">
        <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/80 to-transparent"></div>
    </div>

    <!-- Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="bg-cream max-w-3xl p-8 md:p-12 shadow-2xl border-t-4 border-gold">
            <h2 class="font-serif-custom text-4xl md:text-5xl text-navy leading-tight mb-6">
                Services & what to bring to your first consultation
            </h2>
            <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                An outline of each service we offer. The documents listed are a general guide please contact our office beforehand to confirm exactly what your matter requires. </p>
        </div>
    </div>
</section>

<section id="services" class="py-16 md:py-24 bg-white w-full border-y" x-data="{ 
    openModal: false, 
    selectedService: '', 
    serviceDescription: '',
    requirements: [],
    openService(service, description, reqs) {
        this.selectedService = service;
        this.serviceDescription = description;
        this.requirements = reqs;
        this.openModal = true;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center ">

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
                        Appointment as Liquidator and Trustee in the administration of the estates in liquidations and sequestrations of insolvent individuals, insolvent deceased estates, partnerships, close corporations, company estates, and other legal entities, from appointment through final distribution.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Insolvency Practitioner', 
                    'Appointment as Liquidator and Trustee in the administration of insolvent estates, deceased estates, partnerships, close corporations, companies, and other legal entities, managing the process from initial appointment through asset realisation, settlement of liabilities, and final distribution to creditors and beneficiaries.', 
                    ['ID document / company or CC registration documents', 'Full list of assets and liabilities', 'Recent bank statements (3–6 months)', 'List of creditors with contact details', 'Any summons, letters of demand or court orders received', 'Title deeds or ownership documents for major assets', 'Existing loan and credit agreements']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Reporting and administering deceased estates to the Master of the High Court asset collection, creditor notices, tax clearance, and distribution to heirs in line with the will or intestate succession.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Estate Practitioner', 
                    'Reporting and administering deceased estates to the Master of the High Court asset collection, creditor notices, tax clearance, and distribution to heirs in line with the will or intestate succession.', 
                    ['Death certificate', 'Original will, if one exists', 'ID documents of the deceased and heirs', 'Marriage certificate / antenuptial contract', 'List of assets and liabilities, title deeds, vehicle papers', 'Life policy and bank statement details']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Acting as receiver in the winding-up of business partnerships and universal partnerships, and in the division of assets arising from divorce proceedings.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Receiver', 
                    'Acting as receiver in the winding-up of business partnerships and universal partnerships, and in the division of assets arising from divorce proceedings.', 
                    ['Partnership agreement, or evidence of a universal partnership', 'Divorce order, decree, or summons', 'Schedule of assets and liabilities', 'Recent bank statements', 'Valuations of major assets, where available', 'ID documents of all parties']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Assisting companies and close corporations to wind up voluntarily by special resolution, whether as a members' or a creditors' voluntary winding-up.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Special Resolution', 
                    'Assisting companies and close corporations to wind up voluntarily by special resolution, whether as a members\' or a creditors\' voluntary winding-up.', 
                    ['Certified copy of the special resolution', 'Company / CC registration documents', 'Latest financial statements', 'List of assets and liabilities', 'Creditor list and shareholder / member register']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Independent administration of estates in financial difficulty, structuring repayment and restructuring arrangements as an alternative to formal liquidation.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Administration & Restructuring', 
                    'Independent administration of estates in financial difficulty, structuring repayment and restructuring arrangements as an alternative to formal liquidation.', 
                    ['Current financial statements', 'List of assets and liabilities', 'Existing loan and credit agreements', 'Proof of income', 'Correspondence received from creditors']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Appointment and ongoing administration of curatorships for individuals unable to manage their own financial or personal affairs. </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Curatorships', 
                    'Appointment and ongoing administration of curatorships for individuals unable to manage their own financial or personal affairs.', 
                    ['Medical or psychiatric reports supporting incapacity', 'ID documents of the patient and proposed curator', 'Any existing court application documents', 'List of the patient\'s assets and liabilities', 'Family details and next of kin']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
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
                        Cross border insolvency advice, and acting as a foreign liquidator's agent in Namibia where an insolvent estate or company has assets, creditors or interests in Namibia.
                    </p>
                </div>
                <!-- Updated Button -->
                <button @click="openService(
                    'Cross Border Insolvency', 
                    'Cross border insolvency advice, and acting as a foreign liquidator\'s agent in Namibia where an insolvent estate or company has assets, creditors or interests in Namibia.', 
                    ['Foreign court order or appointment of the liquidator or trustee', 'Certified proof of the foreign liquidator\'s identity and authority', 'Details of the insolvent estate or company and the foreign proceedings', 'Schedule of known assets and creditors in Namibia', 'Title deeds, registration papers or other proof of ownership of Namibian assets', 'Correspondence with creditors or authorities in Namibia']
                )" 
                class="group w-full flex items-center justify-center gap-2 bg-navy text-white text-center font-medium px-6 py-3 hover:bg-[#142c49] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 border border-transparent hover:border-gold">
                    <svg class="w-4 h-4 text-gold group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Schedule an Appointment</span>
                </button>
            </div>
        </div>
    </div>

    <!-- THE MODAL FORM -->
    <div x-show="openModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div x-show="openModal" x-transition:enter="ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="openModal = false"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-4xl">

                <!-- Modal Header -->
                <div class="bg-navy px-6 py-5 border-b-2 border-gold flex justify-between items-center">
                    <div>
                        <span class="inline-block bg-gold/20 text-gold border border-gold px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase mb-2" x-text="selectedService"></span>
                        <h3 class="text-2xl leading-6 font-serif-custom text-white" id="modal-title">Service Details & Request</h3>
                    </div>
                    <button @click="openModal = false" class="text-gray-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="bg-[#fcfbf7] p-6 md:p-8">
                    <!-- Top Section: Description & Requirements -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                     
                        <div>
                            <h4 class="font-serif-custom text-2xl text-navy mb-4">What we do</h4>
                            <p class="text-gray-700 leading-relaxed text-sm md:text-base" x-text="serviceDescription"></p>
                        </div>

                       
                        <div class="bg-navy border border-navy p-6 shadow-md text-left">
                            <h4 class="font-serif-custom text-xl text-gold mb-4">Bring to your first consultation</h4>

                            <ul class="list-disc list-outside ml-4 space-y-2 text-sm text-gray-200 marker:text-gold">
                                <template x-for="req in requirements" :key="req">
                                    <li x-text="req" class="pl-1 leading-relaxed"></li>
                                </template>
                            </ul>

                            <p class="text-xs text-gray-400 italic mt-5 border-t border-gray-700 pt-3">
                                Indicative list — confirm specifics with our office.
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Section: The Form -->
                    <div class="border-t border-gray-300 pt-6">
                        <h4 class="font-serif-custom text-xl text-navy mb-4">Schedule an Appointment</h4>
                        <!-- Form -->
                        <form action="{{ route('service.request') }}" method="POST" class="px-4 py-5 sm:p-6 space-y-4">
                            @csrf
                            <div class="hidden" aria-hidden="true">
                                <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                            </div>
                            <!-- Hidden input for the Service Name -->
                            <input type="hidden" name="service" x-model="selectedService">

                            <!-- Success Message (Displays after submit) -->
                            @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                {{ session('success') }}
                            </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Full Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" required value="{{ old('name') }}" class="block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-white">
                                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" name="email" required value="{{ old('email') }}" class="block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-white">
                                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" name="phone" required value="{{ old('phone') }}" class="block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-white">
                                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Date and Time (New field based on your image) -->
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Date and Time</label>
                                <input type="datetime-local" name="preferred_datetime" value="{{ old('preferred_datetime') }}" class="block w-full border-gray-300 shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-white">
                                @error('preferred_datetime') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200 mt-6">
                                <button type="button" @click="openModal = false" class="inline-flex justify-center bg-white text-navy border border-navy px-6 py-2.5 text-sm font-semibold shadow-sm hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                                <button type="submit" class="inline-flex justify-center bg-navy text-white px-6 py-2.5 text-sm font-semibold shadow-sm hover:bg-gray-800 transition">
                                    Submit Request
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection