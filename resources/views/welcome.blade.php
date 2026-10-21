@extends('layouts.app')

@section('title', 'Welcome - W.D.V. Schickerling')

@section('content')
<!-- Hero Section -->
<section class="bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

            <!-- Left Content -->
            <div class="flex-1 lg:max-w-2xl">
                <h2 class="font-serif-custom text-4xl md:text-5xl lg:text-6xl text-navy leading-tight mb-8">
                    Steady hands for insolvent and deceased estates.
                </h2>
                <p class="text-gray-600 text-base md:text-lg mb-10 leading-relaxed">
                    Wiam Schickerling is a registered Insolvency and Estate Practitioner rendering professional services across Namibia in the administration of estates in liquidations, sequestration, deceased estates, and the winding-up of partnerships, businesses and marriages that have run into difficulty.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#services" class="inline-block bg-navy text-white text-center font-medium px-8 py-3.5 hover:bg-gray-800 transition duration-300">
                        View our services
                    </a>
                    <a href="#" class="inline-block bg-white text-navy border border-navy text-center font-medium px-8 py-3.5 shadow-sm hover:shadow-md hover:bg-navy hover:text-white transition-all duration-300">
                        About the practice
                    </a>
                </div>
            </div>

            <!-- Right Content (Dark Box) -->
            <div class="flex-1 w-full max-w-xl">
                <div class="bg-navy p-8 md:p-10 shadow-lg">
                    <h3 class="font-serif-custom text-xl text-gold mb-6">
                        We render professional service and practise in
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Administration of insolvent estates in Liquidations and Sequestrations</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Deceased estate administration</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Appointment as Receiver in partnerships, universal partnerships & divorce matters</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Voluntary Members / Creditors Winding-up by special resolution</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Estate administration & restructuring</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Curatorships</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <span class="text-gold mr-3 text-lg leading-none mt-1">•</span>
                            <span class="text-sm md:text-base leading-relaxed">Cross border insolvency advice and act as a foreign liquidator's agent in Namibia</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Services Section (Cards) -->
<section id="services" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-serif-custom text-3xl md:text-4xl text-navy mb-6">Our services</h2>
        <p class="text-gray-600 max-w-3xl mb-12 text-lg">
            Every matter is handled with the discretion, record-keeping and legal precision that insolvency and estate work demands.
        </p>

        <!-- Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Insolvency Practitioner</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Administration of the estates in liquidations and sequestrations of insolvent individuals, insolvent deceased estates, partnerships, close corporations, company estates, and other legal entities, from appointment through final distribution.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Estate Practitioner</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Administration of deceased estates (including insolvent deceased estates) from reporting the estate to the Master through to final distribution to heirs.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Appointment as Receiver</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Winding up of business partnerships, universal partnerships, and receiverships arising from divorce proceedings.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Voluntary Members / Creditors Winding-up</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Assist members and creditors with the voluntary winding up of business structures by special resolution, and regularly act as appointed liquidators by attending to the necessary procedures on their behalf and ensure that the entity complies with the prescribed rules that pertain to the winding up of solvent entities.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Administration & Restructuring</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Independent restructuring and administration of estates facing financial difficulty, outside of formal liquidation.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Curatorships</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Appointment and administration of curatorships for persons unable to manage their own affairs.
                </p>
            </div>

            <div class="bg-cream border border-gray-200 p-6 shadow-sm">
                <h4 class="font-serif-custom text-lg text-navy mb-3">Cross Border Insolvency</h4>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Cross border insolvency advice, and acting as a foreign liquidator's agent in Namibia.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection