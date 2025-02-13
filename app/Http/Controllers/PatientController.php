<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Bugo!');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (!Gate::allows('view-patients')) {
            abort(403, 'Bugo!');
        }

        $search = $request->input('search');
        $filter = $request->input('filter');

        $query = Patient::with('doctor');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhereHas('doctor', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($filter === 'archived') {
            $query->onlyTrashed();
        }

        $patients = $query->paginate(10);

        return view('patients.index', compact('patients', 'search', 'filter'));
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function destroy(Patient $patient)
    {
        if (!Gate::allows('delete-patient')) {
            abort(403, 'Unauthorized Access!');
        }

        Log::info("Patient {$patient->id} archived by user " . auth()->user()->id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient archived.');
    }

    public function restore($id)
    {
        if (!Gate::allows('restore-patient')) {
            abort(403, 'Unauthorized Access!');
        }

        $patient = Patient::withTrashed()->findOrFail($id);
        Log::info("Patient {$patient->id} restored by user " . auth()->user()->id);
        $patient->restore();

        return redirect()->route('patients.index')->with('success', 'Patient record restored.');
    }

    public function create()
    {
        $doctors = Doctor::all();

        if ($doctors->isEmpty()) {
            $this->call(DoctorSeeder::class);
            $doctors = Doctor::all();
        }

        return view('patients.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'contact_number' => 'nullable|string|max:20',
            'dob' => 'required|date',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        Patient::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'dob' => $request->dob,
            'doctor_id' => $request->doctor_id,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient added successfully.');
    }

    public function edit(Patient $patient)
    {
        $doctors = Doctor::all();
        return view('patients.edit', compact('patient', 'doctors'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'contact_number' => 'nullable|string|max:20',
            'dob' => 'required|date',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        $patient->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'dob' => $request->dob,
            'doctor_id' => $request->doctor_id ?? $patient->doctor_id,
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient details updated.');
    }
}
