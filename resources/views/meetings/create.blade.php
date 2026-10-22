<x-admin-layout>
    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('admin.meetings.index') }}" class="text-sm text-gray-500 hover:text-navy flex items-center gap-1 mb-2 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to List
                </a>
                <h2 class="font-serif-custom text-2xl text-navy">Add New Estate / Meeting</h2>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.meetings.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Estate Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estate / Matter Name <span class="text-red-500">*</span></label>
                            <input type="text" name="estate_matter" value="{{ old('estate_matter') }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('estate_matter') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Reference -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reference (e.g. L12/2025) <span class="text-red-500">*</span></label>
                            <input type="text" name="reference" value="{{ old('reference') }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('reference') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Status <span class="text-red-500">*</span></label>
                            <input type="text" name="status" value="{{ old('status') }}" required placeholder="e.g. Liquidation & distribution" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('status') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Next Action -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Next Action <span class="text-red-500">*</span></label>
                            <input type="text" name="next_action" value="{{ old('next_action') }}" required placeholder="e.g. First meeting of creditors" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('next_action') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Date and Venue -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date & Venue Details</label>
                        <input type="text" name="date_and_venue" value="{{ old('date_and_venue') }}" placeholder="e.g. 14 Oct 2026, Master's Office, Windhoek" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                        @error('date_and_venue') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Expiry Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Date (Sorting)</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            <p class="text-xs text-gray-500 mt-1">Used to sort the list and calculate dashboard metrics.</p>
                            @error('expiry_date') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- File Link -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Document Link (Optional)</label>
                            <input type="url" name="file_link" value="{{ old('file_link') }}" placeholder="https://example.com/document.pdf" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('file_link') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="flex items-center gap-3 bg-gray-50 p-4 border border-gray-200 rounded-sm">
                        <input type="checkbox" name="view_status" id="view_status" value="1" {{ old('view_status', true) ? 'checked' : '' }} class="rounded border-gray-300 text-navy focus:ring-[#b8935a] w-5 h-5">
                        <label for="view_status" class="text-sm font-medium text-gray-700 cursor-pointer">Show this estate on the public website</label>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="bg-navy text-white px-6 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                            Save Estate
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-admin-layout>