@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="text-green-800 font-bold text-2xl mb-4 text-center">➕ Add New Patient</h2>

    <div class="bg-white shadow-md p-5 rounded-lg w-75 mx-auto">
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="font-semibold text-green-700">First Name: </label>
                    <input type="text" name="first_name" class="form-control border border-green-500 p-2 rounded-lg" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="font-semibold text-green-700">Middle Name: </label>
                    <input type="text" name="middle_name" class="form-control border border-green-500 p-2 rounded-lg">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="font-semibold text-green-700">Last Name: </label>
                    <input type="text" name="last_name" class="form-control border border-green-500 p-2 rounded-lg" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-semibold text-green-700">Email: </label>
                    <input type="email" name="email" class="form-control border border-green-500 p-2 rounded-lg" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-semibold text-green-700">Contact Number: </label>
                    <input type="text" name="contact_number" class="form-control border border-green-500 p-2 rounded-lg" placeholder="+63 900 000 0000">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-semibold text-green-700">Date of Birth: </label>
                    <input type="date" name="dob" class="form-control border border-green-500 p-2 rounded-lg" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="font-semibold text-green-700">Assigned Doctor: </label>
                    <select name="doctor_id" class="form-select border border-green-500 p-2 rounded-lg">
                        <option value="" selected>-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('patients.index') }}" class="btn bg-gray-400 text-white rounded-lg px-4 py-2 hover:bg-gray-500 me-2">
                    🔙 Cancel
                </a>
                <button type="submit" class="btn bg-green-700 text-white rounded-lg px-5 py-2 hover:bg-green-800">
                    ✅ Save Patient
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
