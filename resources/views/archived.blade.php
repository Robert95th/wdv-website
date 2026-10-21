@extends('layouts.app')

@section('title', 'Archives | W.D.V. Schickerling')

@section('content')
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
              Archived  Meetings for Estate Matters
            </h2>
            <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                </p>
        </div>
    </div>
</section>
<section class="py-12 bg-white" x-data="{ 
    search: '', 
    matters: {{ Js::from($matters) }},
    currentPage: 1,
    perPage: 10,
    
    get filteredMatters() {
        if (this.search === '') return this.matters;
        return this.matters.filter(matter => {
            const searchLower = this.search.toLowerCase();
            return (matter.estate_matter && matter.estate_matter.toLowerCase().includes(searchLower)) ||
                   (matter.reference && matter.reference.toLowerCase().includes(searchLower)) ||
                   (matter.status && matter.status.toLowerCase().includes(searchLower)) ||
                   (matter.next_action && matter.next_action.toLowerCase().includes(searchLower)) ||
                   (matter.date_and_venue && matter.date_and_venue.toLowerCase().includes(searchLower));
        });
    },
    
    get paginatedMatters() {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        return this.filteredMatters.slice(start, end);
    },
    
    get totalPages() {
        return Math.ceil(this.filteredMatters.length / this.perPage);
    },
    
    // Reset to page 1 when the user types a new search
    updateSearch(value) {
        this.search = value;
        this.currentPage = 1;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header and Search Bar -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="text-3xl font-serif-custom text-navy mb-2">Archived Meetings</h3>
                <p class="text-gray-700">Stay informed about the Archived meetings and events related to estate matters.</p>
            </div>
            
            <!-- Search Input -->
            <div class="relative w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-on:input="updateSearch($event.target.value)" 
                    placeholder="Search estates..." 
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-sm leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-[#b8935a] focus:ring-1 focus:ring-[#b8935a] sm:text-sm transition"
                >
            </div>
        </div>

        <!-- Table Wrapper for Mobile Scroll -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <!-- Bold header with gold underline -->
                    <tr class="border-b-[3px] border-[#b8935a]">
                        <th class="py-4 px-4 font-bold text-navy text-sm w-1/4">Estate / matter</th>
                        <th class="py-4 px-4 font-bold text-navy text-sm w-[12%]">Reference</th>
                        <th class="py-4 px-4 font-bold text-navy text-sm w-1/4">Status</th>
                        <th class="py-4 px-4 font-bold text-navy text-sm w-1/4">Next action</th>
                        <th class="py-4 px-4 font-bold text-navy text-sm w-1/4">Date & venue</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-200">
                    <!-- Alpine x-for loop using the paginated list -->
                    <template x-for="matter in paginatedMatters" :key="matter.id">
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-5 px-4 text-sm md:text-base text-gray-800 font-medium leading-relaxed" x-text="matter.estate_matter"></td>
                            <td class="py-5 px-4 text-sm md:text-base text-gray-800" x-text="matter.reference"></td>
                            <td class="py-5 px-4">
                                <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-3 py-1 rounded-full text-xs md:text-sm font-medium whitespace-nowrap" x-text="matter.status"></span>
                            </td>
                            <td class="py-5 px-4 text-sm md:text-base text-gray-800 leading-relaxed" x-text="matter.next_action"></td>
                            <td class="py-5 px-4 text-sm md:text-base text-gray-800 leading-relaxed" x-text="matter.date_and_venue"></td>
                        </tr>
                    </template>
                    
                    <!-- Empty State (When Search has no results) -->
                    <tr x-show="filteredMatters.length === 0">
                        <td colspan="5" class="py-8 text-center text-gray-500 italic">
                            No estates found matching "<span x-text="search" class="font-semibold text-navy"></span>".
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4" x-show="totalPages > 1">
            <p class="text-sm text-gray-600">
                Showing <span class="font-medium text-navy" x-text="(currentPage - 1) * perPage + 1"></span> 
                to <span class="font-medium text-navy" x-text="Math.min(currentPage * perPage, filteredMatters.length)"></span> 
                of <span class="font-medium text-navy" x-text="filteredMatters.length"></span> results
            </p>
            
            <nav class="flex items-center gap-2" aria-label="Pagination">
                <!-- Previous Button -->
                <button 
                    x-on:click="if (currentPage > 1) currentPage--" 
                    :disabled="currentPage === 1"
                    class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Previous
                </button>

                <!-- Page Numbers (Optional: shows a simplified version) -->
                <div class="hidden sm:flex items-center gap-1">
                    <template x-for="page in totalPages" :key="page">
                        <button 
                            x-on:click="currentPage = page"
                            x-text="page"
                            :class="{'bg-navy text-white border-navy': currentPage === page, 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': currentPage !== page}"
                            class="px-3 py-2 border rounded-sm text-sm font-medium transition"
                        ></button>
                    </template>
                </div>

                <!-- Next Button -->
                <button 
                    x-on:click="if (currentPage < totalPages) currentPage++" 
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1"
                >
                    Next
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </nav>
        </div>

        <!-- The Alert Box at the bottom -->
        <div class="mt-8 bg-[#fcfbf7] border border-[#e8e2d0] p-4 md:p-5 text-gray-700 text-sm md:text-base shadow-sm rounded-sm flex items-start gap-3">
            <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p>
                Not all estates appear in this list — for the current status of an estate not listed, please contact our office directly.
            </p>
        </div>

    </div>
</section>
@endsection