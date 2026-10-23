<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif-custom text-2xl text-navy leading-tight">
            {{ __('Mailing List Manager') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Success Message -->
            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Welcome / Info Banner -->
            <div class="bg-navy p-6 sm:p-8 rounded-xl shadow-lg border-t-4 border-gold flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="font-serif-custom text-2xl text-gold mb-1">Email Recipients</h1>
                    <p class="text-gray-300 text-sm">Manage the staff members who receive automated daily reminders and request summaries.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column: Add New Recipient Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-serif-custom text-xl text-navy mb-4 border-b border-gray-100 pb-3">Add New Recipient</h3>

                        <form action="{{ route('admin.mailing-list.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Full Name</label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-gray-50"
                                    placeholder="e.g. Jane Doe">
                                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Email Address</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-navy focus:ring-navy sm:text-sm p-2.5 border bg-gray-50"
                                    placeholder="e.g. jane@iande.co">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="w-full bg-navy text-white font-medium py-2.5 rounded-md hover:bg-gray-800 transition duration-300 mt-2">
                                Add to Mailing List
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Current Recipients Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-serif-custom text-xl text-navy">Active Recipients</h3>
                            <span class="bg-cream text-navy text-xs font-bold px-3 py-1 rounded-full border border-gold">
                                {{ $recipients->count() }} Total
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-gray-100 bg-white">
                                        <th class="px-6 py-3 font-medium">Name</th>
                                        <th class="px-6 py-3 font-medium">Email Address</th>
                                        <th class="px-6 py-3 font-medium">Status</th>
                                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($recipients as $recipient)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                                            {{ $recipient->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $recipient->email }}
                                        </td>
                                        <!-- Status Toggle Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.mailing-list.toggle', $recipient) }}" method="POST" id="toggle-form-{{ $recipient->id }}">
                                                @csrf
                                                @method('PATCH')

                                                <label for="toggle-{{ $recipient->id }}" class="flex items-center cursor-pointer group w-max">
                                                    <!-- The Toggle Switch -->
                                                    <div class="relative">
                                                        <input
                                                            type="checkbox"
                                                            id="toggle-{{ $recipient->id }}"
                                                            class="sr-only"
                                                            {{ $recipient->is_active ? 'checked' : '' }}
                                                            onchange="document.getElementById('toggle-form-{{ $recipient->id }}').submit();">
                                                        <!-- Track -->
                                                        <div class="block w-10 h-6 rounded-full transition-colors duration-300 {{ $recipient->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                                        <!-- Thumb -->
                                                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 transform {{ $recipient->is_active ? 'translate-x-4' : '' }}"></div>
                                                    </div>

                                                    <!-- Status Text -->
                                                    <span class="ml-3 text-xs font-semibold tracking-wide uppercase {{ $recipient->is_active ? 'text-green-600' : 'text-gray-400' }}">
                                                        {{ $recipient->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </label>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.mailing-list.destroy', $recipient) }}" method="POST" onsubmit="return confirm('Remove {{ $recipient->name }} from the mailing list?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition p-2 bg-red-50 rounded-full hover:bg-red-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500 italic">
                                            No recipients added yet. Add one using the form.
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