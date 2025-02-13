<div class="navbar bg-green-700 text-white px-8 py-4 flex items-center shadow-md">
    <div class="text-xl font-bold tracking-wide">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition">
            Patient Management System
        </a>
    </div>

    <div class="ml-auto flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition">Dashboard</a>
        <a href="{{ route('patients.index') }}" class="hover:text-gray-200 transition">Patients</a>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 rounded-lg shadow-md transition">
                Logout
            </button>
        </form>
    </div>
</div>
