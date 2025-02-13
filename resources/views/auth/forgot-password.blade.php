<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-green-100">
        <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full border-t-4 border-green-700">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/DOH.png') }}" alt="DOH Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-2xl font-bold text-green-700">Reset Your Password</h2>
            <p class="text-center text-gray-600 mb-6">
                Enter your email, and we will send you a password reset link.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-700" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-green-900 font-medium">Email</label>
                    <input id="email" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-green-600 hover:underline" href="{{ route('login') }}">
                        Back to Login
                    </a>

                    <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 transition">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
