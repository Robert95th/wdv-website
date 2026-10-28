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
                Archived Files for Estate Matters
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
    selectedDoc: null,
    openDocModal: false,
    
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
    
    updateSearch(value) {
        this.search = value;
        this.currentPage = 1;
    },

    // Helper to format file size
    formatSize(bytes) {
        if (!bytes) return 'Unknown size';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header and Search Bar -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="text-3xl font-serif-custom text-navy mb-2">Archived Files</h3>
                <p class="text-gray-700">Stay informed about the Archived files of matters under our administration.</p>
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
                    placeholder="Search files..."
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-sm leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-[#b8935a] focus:ring-1 focus:ring-[#b8935a] sm:text-sm transition">
            </div>
        </div>

        <!-- Table Wrapper for Mobile Scroll -->
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 md:grid-cols-6 border-b-[3px] border-[#b8935a] mb-5 font-bold text-sm md:text-base text-gray-800 pb-5">
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Matters</span></div>
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Reference Number</span></div>
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Status</span></div>
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Next action</span></div>
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Finalization Date</span></div>
                <div class=""><span class="px-3 text-justify text-sm md:text-base text-gray-800 font-medium leading-relaxed">Associated Documents</span></div>
            </div>

            <template x-for="matter in paginatedMatters" :key="matter.id">
                <div class="grid grid-cols-1 md:grid-cols-6 border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out items-center">

                    <!-- Estate / Matter -->
                    <div class="px-3 py-4 flex flex-col md:block">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Matters</span>
                        <span class="text-sm md:text-base text-gray-800 font-medium leading-relaxed" x-text="matter.estate_matter"></span>
                    </div>

                    <!-- Reference -->
                    <div class="px-3 py-4 flex justify-between md:block">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Reference Number</span>
                        <span class="text-sm md:text-base text-gray-800" x-text="matter.reference"></span>
                    </div>

                    <!-- Status -->
                    <div class="px-3 py-4 flex justify-between md:block">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Status</span>
                        <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-3 py-1 rounded-full text-xs md:text-sm font-medium whitespace-nowrap" x-text="matter.status"></span>
                    </div>

                    <!-- Next Action -->
                    <div class="px-3 py-4 flex justify-between md:block gap-4">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mt-0.5">Next action</span>
                        <span class="text-sm md:text-base text-gray-800 leading-relaxed text-right md:text-left" x-text="matter.next_action"></span>
                    </div>

                    <!-- Date & Venue -->
                    <div class="px-3 py-4 flex justify-between md:block gap-4">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mt-0.5">Finalization Date</span>
                        <span class="text-sm md:text-base text-gray-800 leading-relaxed text-right md:text-left" x-text="matter.date_and_venue"></span>
                    </div>

                    <!-- Documents -->
                    <div class="px-3 py-4 flex justify-between md:justify-center md:block gap-4 text-right md:text-center">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider mt-0.5">Files</span>

                        <!-- Check if the 'documents' array exists and has items -->
                        <template x-if="matter.documents && matter.documents.length > 0">
                            <button
                                @click="selectedDoc = matter; openDocModal = true;"
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-navy bg-white border border-gray-300 px-3 py-1.5 rounded-sm hover:border-[#b8935a] hover:bg-[#fcfbf7] transition shadow-sm">
                                <svg class="w-4 h-4 text-[#b8935a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                View (<span x-text="matter.documents.length"></span>)
                            </button>
                        </template>

                        <!-- If no documents, show "No file" -->
                        <template x-if="!matter.documents || matter.documents.length === 0">
                            <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-3 py-1 rounded-full text-xs md:text-sm font-medium whitespace-nowrap italic">No file</span>
                        </template>
                    </div>

                </div>
            </template>

        </div>

        <!-- Pagination Controls -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4" x-show="totalPages > 1">
            <p class="text-sm text-gray-600">
                Showing <span class="font-medium text-navy" x-text="(currentPage - 1) * perPage + 1"></span>
                to <span class="font-medium text-navy" x-text="Math.min(currentPage * perPage, filteredMatters.length)"></span>
                of <span class="font-medium text-navy" x-text="filteredMatters.length"></span> results
            </p>

            <nav class="flex items-center gap-2" aria-label="Pagination">
                <button x-on:click="if (currentPage > 1) currentPage--" :disabled="currentPage === 1" class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Previous
                </button>

                <div class="hidden sm:flex items-center gap-1">
                    <template x-for="page in totalPages" :key="page">
                        <button x-on:click="currentPage = page" x-text="page" :class="{'bg-navy text-white border-navy': currentPage === page, 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': currentPage !== page}" class="px-3 py-2 border rounded-sm text-sm font-medium transition"></button>
                    </template>
                </div>

                <button x-on:click="if (currentPage < totalPages) currentPage++" :disabled="currentPage === totalPages" class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1">
                    Next
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </nav>
        </div>

        <!-- Alert Box -->
        <div class="mt-8 bg-[#fcfbf7] border border-[#e8e2d0] p-4 md:p-5 text-gray-700 text-sm md:text-base shadow-sm rounded-sm flex items-start gap-3">
            <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p>Not all estates appear in this list — for the current status of an estate not listed, please contact our office directly.</p>
        </div>

    </div>

    <!-- Document Modal (Wider to fit table) -->
    <div x-show="openDocModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <!-- Backdrop -->
        <div x-show="openDocModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity"
            @click="openDocModal = false"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="openDocModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-4xl border-t-4 border-gold">

                <!-- Modal Header -->
                <div class="bg-navy px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-serif-custom text-gold" id="modal-title">Estate Documents</h3>
                    <button @click="openDocModal = false" class="text-gray-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-8 bg-[#fcfbf7]">
                    <!-- Estate Info Header -->
                    <div class="mb-6 border-b border-gray-200 pb-4">
                        <h4 class="font-serif-custom text-2xl text-navy mb-1" x-text="selectedDoc?.estate_matter"></h4>
                        <p class="text-sm text-gray-500">Master's Reference: <span class="font-semibold text-gray-700" x-text="selectedDoc?.reference"></span></p>
                    </div>

                    <!-- Documents Table -->
                    <div class="overflow-x-auto bg-white border border-gray-200 rounded-sm shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500">
                                    <th class="px-4 py-3 font-semibold">Document Title</th>
                                    <th class="px-4 py-3 font-semibold">Description</th>
                                    <th class="px-4 py-3 font-semibold">Document Type</th>
                                    <th class="px-4 py-3 font-semibold">Size</th>
                                    <th class="px-4 py-3 font-semibold text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <template x-for="doc in selectedDoc?.documents" :key="doc.id">
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-[#b8935a] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-navy" x-text="doc.title || doc.filename"></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-sm text-gray-600 line-clamp-2" x-text="doc.description || 'No description'"></span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-sm text-gray-600 line-clamp-2" x-text="doc.document_type || 'Not Classified'"></span>
                                        </td>


                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded" x-text="formatSize(doc.size)"></span>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <!-- Assuming your file is stored in storage/app/public/documents/ -->

                                            <a :href="'/storage/documents/' + doc.asset_id+'.pdf'" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-navy bg-white border border-gray-300 px-3 py-1.5 rounded-sm hover:border-[#b8935a] transition">
                                                <svg class="w-3.5 h-3.5 text-[#b8935a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Button -->
                    <div class="flex justify-end mt-6">
                        <button @click="openDocModal = false" class="bg-navy text-white font-medium py-2.5 px-6 rounded-sm hover:bg-gray-800 transition duration-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection