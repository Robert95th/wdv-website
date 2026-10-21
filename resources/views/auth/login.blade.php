<x-guest-layout>
    <!-- Heading -->
    <div class="mb-8 text-center md:text-left">
        <h2 class="font-serif-custom text-3xl text-navy mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-500">Please sign in to access the admin dashboard.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-600 font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-navy mb-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="block w-full border-gray-300 shadow-sm focus:border-gold focus:ring focus:ring-gold/20 sm:text-sm p-3 border rounded-sm bg-gray-50 transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-navy mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full border-gray-300 shadow-sm focus:border-gold focus:ring focus:ring-gold/20 sm:text-sm p-3 border rounded-sm bg-gray-50 transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-navy shadow-sm focus:ring-gold" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gold transition underline decoration-transparent hover:decoration-gold" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-navy text-white font-medium py-3 px-4 rounded-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy transition duration-300 shadow-md">
                {{ __('Log in to Dashboard') }}
            </button>
        </div>
    </form>
</x-guest-layout>