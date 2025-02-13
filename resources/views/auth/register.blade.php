<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-green-100">
        <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full border-t-4 border-green-700">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/DOH.png') }}" alt="DOH Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-2xl font-bold text-green-700">Create an Account</h2>
            <p class="text-center text-gray-600 mb-6">Join the Patient Management System</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-green-900 font-medium">Name</label>
                    <input id="name" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-green-900 font-medium">Email</label>
                    <input id="email" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required autocomplete="username">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-green-900 font-medium">Password</label>
                    <input id="password" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        type="password" name="password" required autocomplete="new-password">
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-green-900 font-medium">Confirm Password</label>
                    <input id="password_confirmation" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                        type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-green-600 hover:underline" href="{{ route('login') }}">
                        Already registered?
                    </a>

                    <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 transition">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
