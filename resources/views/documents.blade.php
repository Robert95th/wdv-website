@extends('layouts.app')

@section('title', 'Public Documents | W.D.V. Schickerling')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-navy flex items-center justify-center min-h-[400px] md:min-h-[500px]">
    <div class="absolute inset-0">
        <img src="{{ asset('images/about-bg1.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-30 blur-md scale-110">
        <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="bg-cream max-w-3xl p-8 md:p-12 shadow-2xl border-t-4 border-gold">
            <h2 class="font-serif-custom text-4xl md:text-5xl text-navy leading-tight mb-6">
                Public Documents & Resources
            </h2>
            <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                Access official forms, notices, and legal documents related to insolvency and estate administration.
            </p>
        </div>
    </div>
</section>

<!-- Documents List Section -->
<section class="py-12 bg-white" x-data="{ 
    search: '', 
    documents: {{ Js::from($documents ?? []) }},
    currentPage: 1,
    perPage: 10,
    
    get filteredDocuments() {
        if (this.search === '') return this.documents;
        return this.documents.filter(doc => {
            const searchLower = this.search.toLowerCase();
            return (doc.title && doc.title.toLowerCase().includes(searchLower)) ||
                   (doc.description && doc.description.toLowerCase().includes(searchLower)) ||
                   (doc.filename && doc.filename.toLowerCase().includes(searchLower));
        });
    },
    
    get paginatedDocuments() {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        return this.filteredDocuments.slice(start, end);
    },
    
    get totalPages() {
        return Math.ceil(this.filteredDocuments.length / this.perPage);
    },
    
    updateSearch(value) {
        this.search = value;
        this.currentPage = 1;
    },
    
    // Helper to format file size (bytes to KB/MB)
    formatSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    },

    // Helper to generate download URL (Adjust based on your actual storage setup)
    getFileUrl(assetId) {
        return '/storage/documents/' + assetId + '.pdf';
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header and Search Bar -->
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="text-3xl font-serif-custom text-navy mb-2">Available Documents</h3>
                <p class="text-gray-700">Download the required forms or review public notices.</p>
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
                    placeholder="Search documents..."
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-sm leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-[#b8935a] focus:ring-1 focus:ring-[#b8935a] sm:text-sm transition">
            </div>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto">
            
            <!-- Table Header -->
            <div class="grid grid-cols-1 md:grid-cols-12 border-b-[3px] border-[#b8935a] mb-5 font-bold text-sm md:text-base text-gray-800 pb-5">
                <div class="md:col-span-6"><span class="px-3 text-gray-800 font-medium leading-relaxed">Document Title & Description</span></div>
                <div class="md:col-span-3"><span class="px-3 text-gray-800 font-medium leading-relaxed">Filename</span></div>
                <div class="md:col-span-1 text-center"><span class="px-3 text-gray-800 font-medium leading-relaxed">Size</span></div>
                <div class="md:col-span-2 text-right md:text-center"><span class="px-3 text-gray-800 font-medium leading-relaxed">Action</span></div>
            </div>

            <!-- Table Body -->
            <template x-for="doc in paginatedDocuments" :key="doc.assetId">
                <div class="grid grid-cols-1 md:grid-cols-12 border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out items-center">
                    
                    <!-- Title & Description -->
                    <div class="px-3 py-4 md:col-span-6 flex flex-col">
                        <span class="text-sm md:text-base text-navy font-bold leading-relaxed mb-1" x-text="doc.title"></span>
                        <span class="text-xs md:text-sm text-gray-600 leading-relaxed" x-text="doc.description"></span>
                    </div>

                    <!-- Filename -->
                    <div class="px-3 py-4 md:col-span-3 flex justify-between md:block">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">File</span>
                        <span class="text-sm text-gray-700 truncate block max-w-[200px]" x-text="doc.filename"></span>
                    </div>

                    <!-- Size -->
                    <div class="px-3 py-4 md:col-span-1 flex justify-between md:block text-center">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Size</span>
                        <span class="text-xs text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded" x-text="formatSize(doc.size)"></span>
                    </div>

                    <!-- Action Button -->
                    <div class="px-3 py-4 md:col-span-2 flex justify-between md:justify-center items-center">
                        <span class="md:hidden text-xs font-bold text-gray-400 uppercase tracking-wider">Action</span>
                        <a :href="getFileUrl(doc.assetId)" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-navy border border-navy px-4 py-2 rounded-sm hover:bg-gray-800 transition shadow-sm w-full md:w-auto justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download
                        </a>
                    </div>

                </div>
            </template>

            <!-- Empty State -->
            <div x-show="filteredDocuments.length === 0" class="text-center py-10 text-gray-500 italic">
                No documents found matching your search.
            </div>
        </div>

        <!-- Pagination Controls -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4" x-show="totalPages > 1">
            <p class="text-sm text-gray-600">
                Showing <span class="font-medium text-navy" x-text="(currentPage - 1) * perPage + 1"></span>
                to <span class="font-medium text-navy" x-text="Math.min(currentPage * perPage, filteredDocuments.length)"></span>
                of <span class="font-medium text-navy" x-text="filteredDocuments.length"></span> documents
            </p>

            <nav class="flex items-center gap-2" aria-label="Pagination">
                <button
                    x-on:click="if (currentPage > 1) currentPage--"
                    :disabled="currentPage === 1"
                    class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Previous
                </button>

                <div class="hidden sm:flex items-center gap-1">
                    <template x-for="page in totalPages" :key="page">
                        <button
                            x-on:click="currentPage = page"
                            x-text="page"
                            :class="{'bg-navy text-white border-navy': currentPage === page, 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': currentPage !== page}"
                            class="px-3 py-2 border rounded-sm text-sm font-medium transition"></button>
                    </template>
                </div>

                <button
                    x-on:click="if (currentPage < totalPages) currentPage++"
                    :disabled="currentPage === totalPages"
                    class="px-3 py-2 border border-gray-300 rounded-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-1">
                    Next
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </nav>
        </div>

    </div>
</section>
@endsection