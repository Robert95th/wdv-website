<x-admin-layout>
    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Area -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="font-serif-custom text-2xl text-navy">Manage Estates & Meetings</h2>
                    <p class="text-sm text-gray-500 mt-1">Add, edit, or remove estates from the public list.</p>
                </div>
                <a href="{{ route('admin.meetings.create') }}" class="bg-navy text-white px-5 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New Estate
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 font-medium">Estate Name</th>
                                <th class="px-6 py-4 font-medium">Reference</th>
                                <th class="px-6 py-4 font-medium">Meeting Date</th>
                                <th class="px-6 py-4 font-medium text-center">Visible</th>
                                <th class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($meetings as $meeting)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-navy">{{ $meeting->estate_matter }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $meeting->reference }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $meeting->expiry_date ? \Carbon\Carbon::parse($meeting->expiry_date)->format('d M Y') : 'Not set' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($meeting->view_status)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Visible</span>
                                        @else
                                            <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Archieved</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm space-x-3 whitespace-nowrap">
                                        <a href="{{ route('admin.meetings.edit', $meeting) }}" class="text-[#b8935a] hover:text-navy font-medium transition">Edit</a>
                                        
                                        <form action="{{ route('admin.meetings.destroy', $meeting) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this estate?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">No estates found. Click "Add New Estate" to get started.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                @if($meetings->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $meetings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-admin-layout>