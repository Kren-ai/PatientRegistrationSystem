@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center">
    <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 max-w-sm md:max-w-lg lg:max-w-xl">
       <h2 class="text-green-800 font-bold text-2xl mb-4 text-center">Edit Patient</h2>
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">First Name</label>
                <input type="text" name="first_name" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->first_name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Middle Name</label>
                <input type="text" name="middle_name" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->middle_name }}" placeholder="Optional">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Last Name</label>
                <input type="text" name="last_name" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->last_name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->email }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Contact Number</label>
                <input type="text" name="contact_number" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->contact_number ?? '' }}" placeholder="Optional">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600"
                       value="{{ $patient->dob }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Assigned Doctor</label>
                <select name="doctor_id" class="w-full border border-green-600 rounded-lg p-2 focus:ring-green-600 focus:border-green-600">
                    <option value="" {{ is_null($patient->doctor_id) ? 'selected' : '' }}>Unassigned</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $patient->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('patients.index') }}" class="bg-gray-400 text-white font-semibold rounded-lg px-4 py-2 hover:bg-gray-500 transition duration-300">
                    Cancel
                </a>
                <button type="submit" class="bg-green-600 text-white font-semibold rounded-lg px-6 py-2 hover:bg-green-700 transition duration-300">
                    Update Patient
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
