@extends('layouts.app')

@section('title', 'Property & Asset Listings - W.D.V. Schickerling')

@section('content')
<!-- Page Header -->
<section class="bg-cream py-12 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-serif-custom text-3xl md:text-4xl text-navy mb-3">Assets & Properties for Sale</h1>
        <p class="text-gray-700 max-w-2xl mx-auto text-base">
            Browse the latest movables, immovable property, and vehicles currently under administration.
        </p>
    </div>
</section>

<!-- Main Content with Alpine Filtering -->
<section class="py-10 bg-[#fcfbf7]" x-data="{ 
    activeFilter: 'All', 
    listings: {{ Js::from($listings) }},
    get filteredListings() {
        if (this.activeFilter === 'All') return this.listings;
        return this.listings.filter(item => item.category === this.activeFilter);
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Pills -->
            <!-- Filter Pills -->
             <!-- Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-8 py-5">
            @foreach($categories as $category)
                <button 
                    @click="activeFilter = '{{ $category }}'"
                    :class="{
                        'bg-navy text-white font-bold border-white': activeFilter === '{{ $category }}', 
                        'bg-[#0a192f] text-[#b8935a] border-[#0a192f] hover:border-[#b8935a]': activeFilter !== '{{ $category }}'
                    }"
                    class="px-4 py-1.5 rounded-full border text-xs font-medium transition duration-200 shadow-sm flex items-center gap-1.5"
                >
                    <!-- Inner span that changes color for the active state -->
                    <span :class="{'bg-[#b8935a] px-2 py-0.5 rounded-full': activeFilter === '{{ $category }}'}">
                        {{ $category }} <span class="opacity-70 text-[10px] ml-1">{{ $counts[$category] }}</span>
                    </span>
                </button>
            @endforeach

            <button 
                @click="activeFilter = 'All'"
                :class="{
                    'bg-[#0a192f] text-[#0a192f] font-bold border-[#0a192f]': activeFilter === 'All', 
                    'bg-[#0a192f] text-[#b8935a] border-[#0a192f] hover:border-[#b8935a]': activeFilter !== 'All'
                }"
                class="px-4 py-1.5 rounded-full border text-xs font-medium transition duration-200 shadow-sm flex items-center gap-1.5"
            >
                <span :class="{'bg-[#b8935a] px-2 py-0.5 rounded-full': activeFilter === 'All'}">
                    All <span class="opacity-70 text-[10px] ml-1">{{ $counts['All'] }}</span>
                </span>
            </button>
        </div>
        <!-- Listings Grid (3 columns on desktop) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 py-5">
            <template x-for="listing in filteredListings" :key="listing.id">
                <div class="bg-[#f4efd9] border border-[#e8e2d0] rounded-sm shadow-sm hover:shadow-md transition duration-300 flex flex-col overflow-hidden group">
                    
                    <!-- Image Area (Smaller height) -->
                    <div class="w-full h-48 relative bg-[#0a192f] flex items-center justify-center overflow-hidden">
                        <!-- If image exists, show it -->
                        <template x-if="listing.image">
                           <img :src="listing.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Property Image">
                        </template>
                        
                        <!-- If no image, show striped placeholder -->
                        <template x-if="!listing.image">
                            <div class="absolute inset-0 flex items-center justify-center" 
                                 style="background-image: repeating-linear-gradient(-45deg, #0a192f, #0a192f 10px, #102442 10px, #102442 20px);">
                                <span class="text-[#b8935a] text-sm font-medium tracking-wide">Photos to be added</span>
                            </div>
                        </template>
                    </div>

                    <!-- Content Area (Tighter padding) -->
                    <div class="p-5 flex-grow flex flex-col">
                        <!-- Category Pill -->
                        <div class="mb-3">
                            <span class="inline-block border border-[#b8935a] text-white px-4 py-2
                            bg-navy
                            rounded-full text-[10px] font-bold uppercase tracking-wider bg-transparent">
                                <span x-text="listing.category"></span>
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="font-serif-custom text-xl text-navy mb-2 leading-snug" x-text="listing.title"></h3>
                        
                        <!-- Description (Smaller text) -->
                        <p class="text-gray-600 text-sm mb-5 leading-relaxed flex-grow line-clamp-3" x-text="listing.description"></p>

                        <!-- Details (Smaller text) -->
                        <div class="space-y-1 text-gray-700 text-xs border-t border-[#e8e2d0] pt-3 mt-auto">
                            <template x-if="listing.auctioneer">
                                <p><strong class="font-semibold text-navy">Auctioneer:</strong> <span x-text="listing.auctioneer"></span></p>
                            </template>
                            <template x-if="listing.date_and_time">
                                <p><strong class="font-semibold text-navy">Date & time:</strong> <span x-text="listing.date_and_time"></span></p>
                            </template>
                            <template x-if="listing.venue">
                                <p><strong class="font-semibold text-navy">Venue:</strong> <span x-text="listing.venue"></span></p>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            
         
        </div>
   <!-- Empty State -->
            <div x-show="filteredListings.length === 0" class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h3 class="text-lg font-medium text-navy mb-1">No listings found</h3>
                <p class="text-gray-500 text-sm">There are currently no assets listed in this category.</p>
            </div>
    </div>
</section>
@endsection