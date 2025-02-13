<div class="navbar bg-green-600 text-white p-4 flex justify-between items-center shadow-md">
    <!-- System Title -->
    <div class="text-lg font-bold tracking-wide">
        <a href="{{route('dashboard')}}">Patient Management System </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex space-x-6">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition">Dashboard</a>
        <a href="{{ route('patients.index') }}" class="hover:text-gray-200 transition">Patients</a>
        <a href="#" class="hover:text-gray-200 transition">Appointments</a>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 rounded-md shadow">
                Logout
            </button>
        </form>
    </div>
</div>
