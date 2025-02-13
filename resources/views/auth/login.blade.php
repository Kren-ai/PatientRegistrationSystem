<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-green-100">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/DOH.png') }}" alt="DOH Logo" class="h-20">
            </div>
            <h2 class="text-center text-2xl font-bold text-green-700">Patient Management System</h2>
            <p class="text-center text-gray-600 mb-6">Department of Health</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-green-900 font-medium">Email</label>
                    <input id="email" class="block w-full mt-1 p-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-green-900 font-medium">Password</label>
                    <input id="password" class="block w-full mt-1 p-3 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"
                        type="password" name="password" required autocomplete="current-password">
                </div>

                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" class="rounded border-green-400 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">Remember me</label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:underline" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" class="px-5 py-2 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 transition">
                        Log in
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Don't have an account?
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
