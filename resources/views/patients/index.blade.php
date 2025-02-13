@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-green-800 font-bold text-2xl mb-4 text-center">Patient Management</h2>

    <!-- Search & Filter Panel -->
    <div class="bg-white shadow-md p-4 rounded-lg mb-5">
        <form action="{{ route('patients.index') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search patients..."
                   class="form-control me-2 border border-green-700 rounded-lg p-2">
            <select name="filter" class="form-select me-2 border border-green-700 rounded-lg p-2">
                <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>Active Patients</option>
                <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>Archived Patients</option>
            </select>
            <button type="submit" class="btn bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700">
                Search
            </button>
        </form>
    </div>

    <!-- Professional Table Layout -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle w-100">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="p-3 text-lg">Name</th>
                        <th class="p-3 text-lg">Email</th>
                        <th class="p-3 text-lg">Date of Birth</th>
                        <th class="p-3 text-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($patients as $patient)
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="p-3 font-semibold">{{ $patient->name }}</td>
                            <td class="p-3">
                                @can('view-sensitive-data')
                                    {{ $patient->email }}
                                @else
                                    *****@****
                                @endcan
                            </td>
                            <td class="p-3">{{ $patient->dob }}</td>
                            <td class="p-3">
                                @if (request('filter') == 'archived')
                                    @can('restore-patient')
                                        <form action="{{ route('patients.restore', $patient->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm rounded-lg px-3">
                                                🔄 Restore
                                            </button>
                                        </form>
                                    @endcan
                                @else
                                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm rounded-lg px-3">
                                        ✏️ Edit
                                    </a>
                                    @can('delete-patient')
                                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-lg px-3">
                                                🗑️ Archive
                                            </button>
                                        </form>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection
