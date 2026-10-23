<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif-custom text-2xl text-navy leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Header Banner -->
            <div
                class="bg-navy p-6 sm:p-8 rounded-xl shadow-lg border-t-4 border-gold flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="font-serif-custom text-2xl text-gold mb-1">System Users</h1>
                    <p class="text-gray-300 text-sm">Add or remove staff members who can access this dashboard.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Add User Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-serif-custom text-xl text-navy mb-4 border-b border-gray-100 pb-3">Add New User
                        </h3>

                        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Full Name</label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-gray-50"
                                    placeholder="e.g. John Doe">
                                @error('name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Email Address</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-gray-50"
                                    placeholder="e.g. john@iande.co">
                                @error('email')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Password</label>
                                <input type="password" name="password" required
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-gray-50"
                                    placeholder="Minimum 8 characters">
                                @error('password')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-navy text-white font-medium py-2.5 rounded-md hover:bg-gray-800 transition duration-300 mt-2">
                                Create User
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-serif-custom text-xl text-navy">Current Users</h3>
                            <span
                                class="bg-cream text-navy text-xs font-bold px-3 py-1 rounded-full border border-gold">
                                {{ $users->count() }} Total
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr
                                        class="text-xs text-gray-500 uppercase tracking-wider border-b border-gray-100 bg-white">
                                        <th class="px-6 py-3 font-medium">Name</th>
                                        <th class="px-6 py-3 font-medium">Email</th>
                                        <th class="px-6 py-3 font-medium">Joined</th>
                                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($users as $user)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                                                {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if (auth()->id() !== $user->id && strtolower($user->email) !== 'wdvsuper@wdv.com')
                                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to remove {{ $user->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-700 transition p-2 bg-red-50 rounded-full hover:bg-red-100"
                                                            title="Delete User">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @elseIf(strtolower($user->email) == 'wdvsuper@wdv.com')
                                                    <span class="text-xs text-gray-400 italic">Protected Account</span>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Current User</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="px-6 py-12 text-center text-sm text-gray-500 italic">
                                                No users found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
