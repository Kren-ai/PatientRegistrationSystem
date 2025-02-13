@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-green-800 font-bold text-2xl mb-4 text-center">Dashboard</h2>

    <div class="bg-white shadow-md p-4 rounded-lg mb-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h3 class="text-lg font-semibold text-gray-800">Welcome, Department of Health KMITS! 👋</h3>
                <p class="text-gray-600">Here is a simple system for Patient Registry, View, Edit, Archived, Data Privacy & Compliance and Advanced Search and Filterning</p>
            </div>
            <div class="d-flex justify-content-between text-right w-100 mt-3 mt-md-0">
                <a href="{{ route('patients.create') }}" class="btn bg-green-700 text-white rounded-lg px-4 py-2 hover:bg-green-800 me-2">
                    ➕ Add Patient
                </a>
                <a href="{{ route('doctors.index') }}" class="btn bg-blue-700 text-white rounded-lg px-4 py-2 hover:bg-blue-800">
                    🩺 Manage Doctors
                </a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="bg-green-600 text-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold">Total Patients</h3>
                <p class="text-3xl font-bold">{{ \App\Models\Patient::count() }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-blue-600 text-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold">Doctors Available</h3>
                <p class="text-3xl font-bold">{{ \App\Models\Doctor::count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
