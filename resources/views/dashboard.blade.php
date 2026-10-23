<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif-custom text-2xl text-navy leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Message -->
            <div class="bg-navy p-6 sm:p-8 rounded-xl shadow-lg border-t-4 border-gold flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="font-serif-custom text-2xl text-gold mb-1">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-300 text-sm">Here is the latest overview of your practice's activities.</p>
                </div>
                <div class="flex gap-3">
                    <a href="/" target="_blank" class="bg-transparent border border-gold text-gold hover:bg-gold hover:text-navy px-4 py-2 rounded-sm text-sm font-medium transition">
                        View Public Site
                    </a>
                </div>
            </div>
            <!-- ... Keep all your Metrics and Tables here ... -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Metric 1: Upcoming Meetings -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-navy shrink-0 border border-gold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Meetings</p>
                        <h3 class="text-2xl font-bold text-navy">{{ $totalMeetings }}</h3>
                    </div>
                </div>
                <!-- Metric 2: Meetings This Month -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-navy shrink-0 border border-gold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Meetings This Month</p>
                        <h3 class="text-2xl font-bold text-navy">{{ $meetingsThisMonth }}</h3>
                    </div>
                </div>
                <!-- Metric 3: Properties Listed -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-navy shrink-0 border border-gold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Properties Listed</p>
                        <h3 class="text-2xl font-bold text-navy">{{ $totalProperties }}</h3>
                    </div>
                </div>
                <!-- Metric 4: Service Requests -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-navy shrink-0 border border-gold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Service Requests</p>
                        <h3 class="text-2xl font-bold text-navy">{{ $totalRequests }}</h3>
                    </div>
                </div>
            </div>
            <!-- Tables Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Upcoming Meetings Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-serif-custom text-lg text-navy">Upcoming Meetings</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-gray-100 bg-white">
                                    <th class="px-5 py-3 font-medium">Estate</th>
                                    <th class="px-5 py-3 font-medium">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($upcomingMeetings as $meeting)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-4 text-sm text-gray-800 font-medium">{{ $meeting->estate_matter }}</td>
                                    <td class="px-5 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($meeting->expiry_date)->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-5 py-8 text-center text-sm text-gray-500 italic">No upcoming meetings scheduled.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Latest Requests Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-serif-custom text-lg text-navy">Latest Service Requests</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-gray-100 bg-white">
                                    <th class="px-5 py-3 font-medium">Name</th>
                                    <th class="px-5 py-3 font-medium">Service</th>
                                    <th class="px-5 py-3 font-medium text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($latestRequests as $request)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-4 text-sm text-gray-800 font-medium">
                                        {{ $request->name }}
                                        <span class="block text-xs text-gray-400 font-normal">{{ $request->email }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-600">
                                        <span class="inline-block bg-[#efe8d5] text-[#8c7a5b] px-2 py-0.5 rounded-full text-xs font-medium">{{ $request->service }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-500 text-right">{{ $request->created_at->format('d M') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-sm text-gray-500 italic">No service requests yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Add this to your dashboard grid -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-[#0a192f]">
                    <h4 class="font-bold text-lg mb-2">Mailing List</h4>
                    <p class="text-sm text-gray-500 mb-4">Manage who receives the automated daily meeting and request emails.</p>
                    <a href="{{ route('admin.mailing-list') }}" class="inline-block text-sm bg-[#0a192f] text-white px-4 py-2 rounded hover:bg-gray-800 transition">Manage Recipients</a>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>