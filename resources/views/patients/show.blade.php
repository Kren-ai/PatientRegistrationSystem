@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center">
    <div class="bg-white shadow-md rounded-lg p-6 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 max-w-sm md:max-w-lg lg:max-w-xl">
        <h2 class="text-green-800 font-bold text-2xl mb-4 text-center">Patient Details</h2>
        <div class="grid grid-cols-1 gap-4 text-md">
            <div class="flex justify-between">
                <span class="font-semibold">Full Name:</span>
                <span class="text-gray-700">{{ $patient->first_name }} {{ $patient->middle_name ?? '' }} {{ $patient->last_name }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">Email:</span>
                <span class="text-gray-700">{{ $patient->email }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">Contact Number:</span>
                <span class="text-gray-700">{{ $patient->contact_number ?? 'N/A' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">Date of Birth:</span>
                <span class="text-gray-700">{{ $patient->dob }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">Assigned Doctor:</span>
                <span class="text-gray-700">{{ $patient->doctor->name ?? 'Unassigned' }}</span>
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <a href="{{ route('patients.index') }}" class="bg-green-600 text-white font-semibold rounded-lg px-6 py-2 hover:bg-green-700 transition duration-300">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
