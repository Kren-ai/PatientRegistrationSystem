@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-green-800 font-bold text-xl mb-4">Patient Management</h2>

    <!-- Search & Filter Panel -->
    <div class="bg-white shadow-md p-4 rounded-lg mb-4">
        <form action="{{ route('patients.index') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search patients..."
                   class="form-control me-2 border border-green-400 rounded-lg p-2">
            <select name="filter" class="form-select me-2 border border-green-400 rounded-lg p-2">
                <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>Active Patients</option>
                <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>Archived Patients</option>
            </select>
            <button type="submit" class="btn bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700">
                Search
            </button>
        </form>
    </div>

    <!-- Patient Table -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <table class="table table-striped">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->name }}</td>
                        <td>
                            @can('view-sensitive-data')
                                {{ $patient->email }}
                            @else
                                *****@****
                            @endcan
                        </td>
                        <td>{{ $patient->dob }}</td>
                        <td class="text-center">
                            @if (request('filter') == 'archived')
                                @can('restore-patient')
                                    <form action="{{ route('patients.restore', $patient->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">🔄 Restore</button>
                                    </form>
                                @endcan
                            @else
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                @can('delete-patient')
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Archive</button>
                                    </form>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection
