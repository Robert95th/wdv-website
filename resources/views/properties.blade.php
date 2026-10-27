@extends('layouts.app')

@section('title', 'Assets & Properties for Sale - W.D.V. Schickerling')

@section('content')

    {{-- =========================================================
     PAGE HEADER
========================================================= --}}
    <section class="relative overflow-hidden min-h-[350px] md:min-h-[500px] :md:flex items-center grid grid-cols-1 ">
        <!-- 1. Blurry Background Layer -->
        <div class="absolute inset-0 bg-cover bg-center blur-md scale-110"
            style="background-image: url('{{ asset('images/about-bg1.jpg') }}');">
        </div>

        <div class="absolute inset-0 bg-navy/60"></div>
        
        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
            <div class="relative overflow-hidden bg-[#0a192f] rounded-lg shadow-2xl">
                <div class="absolute inset-0 pointer-events-none opacity-10"
                    style="background-image: url('{{ asset('images/about-bg3.jpg') }}');">
                </div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
                    <div class="max-w-3xl mx-auto text-center">

                        <div class="inline-flex items-center gap-2 px-3 py-1.5 md:px-4 md:py-2 mb-4 md:mb-5 rounded-full border border-[#b8935a]/40 bg-white/5">
                            <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-[#b8935a]"></span>
                            <span class="text-[#d8bd85] text-[10px] md:text-sm font-semibold tracking-widest uppercase">
                                W.D.V. Schickerling
                            </span>
                        </div>

                        <h1 class="font-serif-custom text-3xl sm:text-4xl lg:text-5xl text-white leading-tight">
                            Assets & Properties
                            <span class="block text-[#d8bd85] mt-1">for Sale</span>
                        </h1>

                        <p class="mt-4 md:mt-5 text-gray-300 text-xs sm:text-sm md:text-base leading-relaxed max-w-2xl mx-auto px-2">
                            Explore available immovable properties, movable assets and vehicles currently under administration.
                        </p>
                    </div>
                </div>

                <div class="h-1 bg-gradient-to-r from-[#0a192f] via-[#b8935a] to-[#0a192f]"></div>
            </div>
        </div>
    </section>

    {{-- =========================================================
     LISTINGS
========================================================= --}}
    <section class="bg-[#f8f7f3] py-8 sm:py-12 lg:py-14" x-data="{
        activeFilter: 'All',
        searchTerm: '',
        listings: {{ Js::from($listings) }},
        
        // Lightbox Modal State
        galleryOpen: false,
        currentImages: [],
        currentIndex: 0,
        currentTitle: '',

        openGallery(listing) {
            // If a property has no images, we shouldn't open the modal
            if (!listing.all_images || listing.all_images.length === 0) return;
            
            this.currentImages = listing.all_images;
            this.currentTitle = listing.title;
            this.currentIndex = 0;
            this.galleryOpen = true;
        },
        nextImage() {
            if (this.currentIndex < this.currentImages.length - 1) this.currentIndex++;
        },
        prevImage() {
            if (this.currentIndex > 0) this.currentIndex--;
        },
    
        get filteredListings() {
            const term = this.searchTerm.trim().toLowerCase();
    
            return this.listings.filter(item => {
                const matchesCategory = this.activeFilter === 'All' || item.category === this.activeFilter;
                const searchableText = [item.title, item.description, item.category, item.auctioneer, item.venue, item.date_and_time].filter(Boolean).join(' ').toLowerCase();
                const matchesSearch = term === '' || searchableText.includes(term);
                return matchesCategory && matchesSearch;
            });
        }
    }" x-cloak>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section heading and count --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 md:mb-8">
                <div>
                    <p class="text-[#a17b3f] text-[10px] md:text-xs font-bold uppercase tracking-[0.18em] mb-1.5 md:mb-2">
                        Explore available assets
                    </p>
                    <h2 class="font-serif-custom text-2xl sm:text-3xl text-[#0a192f]">
                        Browse Listings
                    </h2>
                    <p class="mt-1.5 md:mt-2 text-xs md:text-sm text-gray-600">
                        Find an asset by category, title or location.
                    </p>
                </div>

                <div class="inline-flex items-center gap-2 self-start sm:self-auto bg-white border border-gray-200 rounded-lg px-3 py-2 md:px-4 md:py-3 shadow-sm">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-[#b8935a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="text-xs md:text-sm text-gray-600">Showing</span>
                    <span class="font-bold text-[#0a192f] text-sm md:text-base" x-text="filteredListings.length"></span>
                    <span class="text-xs md:text-sm text-gray-600" x-text="filteredListings.length === 1 ? 'listing' : 'listings'"></span>
                </div>
            </div>

            {{-- Search --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-3 sm:p-4 mb-5">
                <label for="listing-search" class="block text-xs md:text-sm font-semibold text-[#0a192f] mb-2">
                    Search listings
                </label>

                <div class="flex items-center gap-2 md:gap-3 px-3 py-2.5 md:py-3 border border-gray-200 rounded-lg bg-gray-50 focus-within:bg-white focus-within:border-[#b8935a] focus-within:ring-2 focus-within:ring-[#b8935a]/20 transition">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4" />
                    </svg>

                    <input id="listing-search" type="search" x-model="searchTerm"
                        placeholder="Search assets or locations..."
                        class="w-full bg-transparent text-sm text-gray-800 placeholder-gray-400 outline-none border-0 focus:ring-0 p-0"
                        autocomplete="off">

                    <button type="button" x-show="searchTerm.length > 0" @click="searchTerm = ''"
                        class="text-xs font-semibold text-[#8b6a34] hover:text-[#0a192f] whitespace-nowrap px-2 py-1"
                        aria-label="Clear search">
                        Clear
                    </button>
                </div>
            </div>

            {{-- Category filters --}}
            <div class="mb-6 md:mb-8">
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 md:mb-3">
                    Filter by category
                </p>

                <div class="" role="group" aria-label="Filter listings by category">
                    
                    <button type="button" @click="activeFilter = 'All'" :aria-pressed="activeFilter === 'All'"
                        :class="activeFilter === 'All' ? 'bg-[#0a192f] text-white border-[#0a192f] shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:border-[#b8935a] hover:text-[#0a192f]'"
                        class="shrink-0 inline-flex items-center gap-1.5 md:gap-2 px-3 py-2 md:px-4 md:py-2.5 rounded-lg border text-xs md:text-sm font-semibold transition duration-200 m-1">
                        All assets
                        <span :class="activeFilter === 'All' ? 'bg-white/15 text-white' : 'bg-gray-100 text-gray-600'" class="rounded-md px-1.5 py-0.5 text-[10px] md:text-xs">
                            {{ $counts['All'] ?? count($listings) }}
                        </span>
                    </button>

                    @foreach ($categories as $category)
                        <button type="button" @click="activeFilter = @js($category)" :aria-pressed="activeFilter === @js($category)"
                            :class="activeFilter === @js($category) ? 'bg-[#0a192f] text-white border-[#0a192f] shadow-md' : 'bg-white text-gray-700 border-gray-200 hover:border-[#b8935a] hover:text-[#0a192f]'"
                            class="shrink-0 inline-flex m-1 items-center gap-1.5 md:gap-2 px-3 py-2 md:px-4 md:py-2.5 rounded-lg border text-xs md:text-sm font-semibold transition duration-200">
                            {{ $category }}
                            <span :class="activeFilter === @js($category) ? 'bg-white/15 text-white' : 'bg-gray-100 text-gray-600'" class="rounded-md px-1.5 py-0.5 text-[10px] md:text-xs">
                                {{ $counts[$category] ?? 0 }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>


            {{-- Listings grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6" aria-live="polite" aria-atomic="false">

                <template x-for="listing in filteredListings" :key="listing.id">
                    
                    <!-- Changed to a clickable div to trigger the modal -->
                    <article @click="openGallery(listing)" class="group cursor-pointer bg-white rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-xl md:hover:-translate-y-1 transition-all duration-300 flex flex-col">

                        {{-- Image --}}
                        <div class="relative h-48 md:h-56 overflow-hidden bg-[#0a192f]">
                            <template x-if="listing.image">
                                <!-- Handle both local storage paths and external URLs -->
                                <img :src="listing.image.startsWith('http') ? listing.image : '/storage/' + listing.image" 
                                     :alt="listing.title ? 'Image of ' + listing.title : 'Asset listing image'"
                                     loading="lazy" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </template>

                            <template x-if="!listing.image">
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4" style="background-image: linear-gradient(135deg, #0a192f 0%, #142c49 100%);">
                                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-full border border-[#b8935a]/40 bg-white/5 flex items-center justify-center mb-2 md:mb-3">
                                        <svg class="w-5 h-5 md:w-7 md:h-7 text-[#d8bd85]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <rect x="3" y="4" width="18" height="16" rx="2" stroke-width="1.5" />
                                            <circle cx="8.5" cy="9" r="1.5" stroke-width="1.5" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 15-5-5L5 20" />
                                        </svg>
                                    </div>
                                    <p class="text-[#d8bd85] text-xs md:text-sm font-semibold">Image coming soon</p>
                                </div>
                            </template>

                            {{-- Category badge --}}
                            <div class="absolute top-2 left-2 md:top-3 md:left-3">
                                <span class="inline-flex items-center px-2.5 py-1 md:px-3 md:py-1.5 rounded-md bg-[#0a192f]/90 text-white text-[9px] md:text-[10px] font-bold uppercase tracking-wider border border-white/15 backdrop-blur-sm" x-text="listing.category"></span>
                            </div>

                            {{-- Photo Count Badge --}}
                            <div class="absolute bottom-2 right-2 md:bottom-3 md:right-3" x-show="listing.all_images && listing.all_images.length > 0">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-black/70 text-white text-xs font-medium backdrop-blur-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span x-text="listing.all_images.length"></span>
                                </span>
                            </div>
                        </div>

                        {{-- Card content --}}
                        <div class="p-4 md:p-6 flex flex-col flex-1">
                            {{-- Title --}}
                            <h3 class="font-serif-custom text-lg md:text-xl text-[#0a192f] leading-snug group-hover:text-[#8b6a34] transition-colors" x-text="listing.title"></h3>

                            {{-- Description --}}
                            <p class="mt-2 md:mt-3 text-xs md:text-sm text-gray-600 leading-relaxed line-clamp-3" x-text="listing.description"></p>

                            {{-- Listing details --}}
                            <div class="mt-4 md:mt-5 pt-3 md:pt-4 border-t border-gray-100 space-y-2 md:space-y-3">
                                <template x-if="listing.auctioneer">
                                    <div class="flex items-start gap-2 md:gap-3">
                                        <div class="shrink-0 mt-0.5 text-[#a17b3f]">
                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <circle cx="12" cy="8" r="3" stroke-width="1.6" />
                                                <path stroke-linecap="round" stroke-width="1.6" d="M5 20v-2a7 7 0 0 1 14 0v2" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[10px] md:text-xs text-gray-500">Auctioneer</p>
                                            <p class="text-xs md:text-sm font-medium text-gray-800 break-words" x-text="listing.auctioneer"></p>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="listing.date_and_time">
                                    <div class="flex items-start gap-2 md:gap-3">
                                        <div class="shrink-0 mt-0.5 text-[#a17b3f]">
                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <rect x="3" y="5" width="18" height="16" rx="2" stroke-width="1.6" />
                                                <path stroke-linecap="round" stroke-width="1.6" d="M16 3v4M8 3v4M3 10h18" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[10px] md:text-xs text-gray-500">Date &amp; time</p>
                                            <p class="text-xs md:text-sm font-medium text-gray-800 break-words" x-text="listing.date_and_time"></p>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="listing.venue">
                                    <div class="flex items-start gap-2 md:gap-3">
                                        <div class="shrink-0 mt-0.5 text-[#a17b3f]">
                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                                                <circle cx="12" cy="10" r="2.5" stroke-width="1.6" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[10px] md:text-xs text-gray-500">Venue</p>
                                            <p class="text-xs md:text-sm font-medium text-gray-800 break-words" x-text="listing.venue"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </article>
                </template>

            </div>

            {{-- Empty state --}}
            <div x-show="filteredListings.length === 0" x-cloak class="mt-6 bg-white border border-gray-200 rounded-xl px-4 py-12 md:px-5 md:py-20 text-center">
                <div class="w-12 h-12 md:w-16 md:h-16 mx-auto rounded-full bg-[#f8f5ed] flex items-center justify-center mb-4 md:mb-5">
                    <svg class="w-6 h-6 md:w-8 md:h-8 text-[#a17b3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="10.5" cy="10.5" r="6.5" stroke-width="1.6" />
                        <path stroke-linecap="round" stroke-width="1.6" d="m15.5 15.5 5 5" />
                    </svg>
                </div>
                <h3 class="font-serif-custom text-lg md:text-2xl text-[#0a192f]">No listings found</h3>
                <p class="mt-2 text-xs md:text-sm text-gray-500 max-w-md mx-auto leading-relaxed">
                    We couldn't find any assets matching your search or selected category. Try another search or browse all available listings.
                </p>
                <button type="button" @click="activeFilter = 'All'; searchTerm = ''"
                    class="mt-5 md:mt-6 inline-flex items-center justify-center gap-2 bg-[#0a192f] hover:bg-[#142c49] text-white px-4 py-2.5 md:px-5 md:py-3 rounded-lg text-xs md:text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-[#b8935a] focus:ring-offset-2">
                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 12h16m-6-6 6 6-6 6" />
                    </svg>
                    Show all listings
                </button>
            </div>

        </div>

        {{-- ========================================== --}}
        {{-- LIGHTBOX GALLERY MODAL --}}
        {{-- ========================================== --}}
        <div x-show="galleryOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-md" 
             @keydown.escape.window="galleryOpen = false" 
             @keydown.right.window="nextImage()" 
             @keydown.left.window="prevImage()">
            
            <!-- Close Button -->
            <button @click="galleryOpen = false" class="absolute top-4 right-4 md:top-8 md:right-8 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 p-2 md:p-3 rounded-full transition z-50">
                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Title & Counter -->
            <div class="absolute top-4 left-4 md:top-8 md:left-8 z-50 bg-black/60 px-4 py-2 rounded-lg pointer-events-none">
                <h3 class="text-white font-serif-custom text-lg md:text-xl truncate max-w-[200px] md:max-w-md" x-text="currentTitle"></h3>
                <p class="text-gray-400 text-sm mt-1">
                    Image <span x-text="currentIndex + 1"></span> of <span x-text="currentImages.length"></span>
                </p>
            </div>

            <!-- Previous Button -->
            <button @click.stop="prevImage()" x-show="currentIndex > 0" class="absolute left-2 md:left-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white bg-black/50 hover:bg-black/80 p-3 md:p-4 rounded-full transition z-50">
                <svg class="w-6 h-6 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <!-- Main Image Container (Clicking background closes) -->
            <div class="w-full h-full flex items-center justify-center p-4 md:p-16" @click="galleryOpen = false">
                <img :src="currentImages[currentIndex]" class="max-w-full max-h-full object-contain shadow-2xl rounded-md" @click.stop>
            </div>

            <!-- Next Button -->
            <button @click.stop="nextImage()" x-show="currentIndex < currentImages.length - 1" class="absolute right-2 md:right-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white bg-black/50 hover:bg-black/80 p-3 md:p-4 rounded-full transition z-50">
                <svg class="w-6 h-6 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Thumbnail Strip (Desktop only) -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 hidden md:flex gap-2 z-50 bg-black/60 p-2 rounded-lg max-w-4xl overflow-x-auto" x-show="currentImages.length > 1">
                <template x-for="(img, index) in currentImages" :key="index">
                    <button @click.stop="currentIndex = index" class="shrink-0 w-16 h-12 rounded overflow-hidden border-2 transition" :class="currentIndex === index ? 'border-[#b8935a]' : 'border-transparent opacity-50 hover:opacity-100'">
                        <img :src="img" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
        </div>

    </section>

@endsection