<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-serif-custom text-2xl text-navy leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-[#fcfbf7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header Banner -->
            <div class="bg-navy p-6 sm:p-8 rounded-xl shadow-lg border-t-4 border-gold">
                <h1 class="font-serif-custom text-2xl text-gold mb-1">Account Details</h1>
                <p class="text-gray-300 text-sm">Update your account's profile information, email address, and password.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Update Info & Password -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Update Profile Info -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-serif-custom text-xl text-navy mb-4 border-b border-gray-100 pb-3">Profile Information</h3>
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-serif-custom text-xl text-navy mb-4 border-b border-gray-100 pb-3">Update Password</h3>
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Right Column: Delete Account -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-red-100 border-l-4 border-l-red-500">
                        <h3 class="font-serif-custom text-xl text-red-600 mb-4 border-b border-red-100 pb-3">Delete Account</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                        </p>
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>