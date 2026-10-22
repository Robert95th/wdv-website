<x-admin-layout>
    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('admin.meetings.index') }}" class="text-sm text-gray-500 hover:text-navy flex items-center gap-1 mb-2 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to List
                </a>
                <h2 class="font-serif-custom text-2xl text-navy">Edit Estate: {{ $meeting->reference }}</h2>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 sm:p-8">
                <form action="{{ route('admin.meetings.update', $meeting) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Estate Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estate / Matter Name <span class="text-red-500">*</span></label>
                            <input type="text" name="estate_matter" value="{{ old('estate_matter', $meeting->estate_matter) }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('estate_matter') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Reference -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reference <span class="text-red-500">*</span></label>
                            <input type="text" name="reference" value="{{ old('reference', $meeting->reference) }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('reference') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Status <span class="text-red-500">*</span></label>
                            <input type="text" name="status" value="{{ old('status', $meeting->status) }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('status') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Next Action -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Next Action <span class="text-red-500">*</span></label>
                            <input type="text" name="next_action" value="{{ old('next_action', $meeting->next_action) }}" required class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('next_action') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Date and Venue -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date & Venue Details</label>
                        <input type="text" name="date_and_venue" value="{{ old('date_and_venue', $meeting->date_and_venue) }}" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                        @error('date_and_venue') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Expiry Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meeting Date (Sorting)</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date', $meeting->expiry_date ? \Carbon\Carbon::parse($meeting->expiry_date)->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('expiry_date') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- File Link -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Document Link (Optional)</label>
                            <input type="url" name="file_link" value="{{ old('file_link', $meeting->file_link) }}" class="w-full border-gray-300 rounded-sm shadow-sm focus:border-[#b8935a] focus:ring-[#b8935a] p-2.5 border">
                            @error('file_link') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="flex items-center gap-3 bg-gray-50 p-4 border border-gray-200 rounded-sm">
                        <input type="checkbox" name="view_status" id="view_status" value="1" {{ old('view_status', $meeting->view_status) ? '' : 'checked' }} class="rounded border-gray-300 text-navy focus:ring-[#b8935a] w-5 h-5">
                        <label for="view_status" class="text-sm font-medium text-gray-700 cursor-pointer">This meeting is archieved</label>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="bg-navy text-white px-6 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition shadow-sm">
                            Update Estate
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-admin-layout>