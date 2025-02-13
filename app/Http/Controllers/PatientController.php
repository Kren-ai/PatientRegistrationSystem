<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Patient;
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
                abort(403, 'Bugo gyud ka!');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (!Gate::allows('view-patients')) {
            abort(403, 'Bugo gyud ka!');
        }

        $search = $request->input('search');
        $filter = $request->input('filter');

        $query = Patient::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('dob', 'like', "%{$search}%");
        }

        if ($filter === 'archived') {
            $query->onlyTrashed();
        }

        $patients = $query->paginate(10);

        return view('patients.index', compact('patients', 'search', 'filter'));
    }

    public function destroy(Patient $patient)
    {
        if (!Gate::allows('delete-patient')) {
            abort(403, 'Unauthorized Access');
        }

        Log::info("Patient {$patient->id} archived by user " . auth()->user()->id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient archived.');
    }

    public function restore($id)
    {
        if (!Gate::allows('restore-patient')) {
            abort(403, 'Bugo gyud ka!');
        }

        $patient = Patient::withTrashed()->findOrFail($id);
        Log::info("Patient {$patient->id} restored by user " . auth()->user()->id);
        $patient->restore();

        return redirect()->route('patients.index')->with('success', 'Patient record restored.');
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'dob' => 'required|date',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient added successfully.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'dob' => 'required|date',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient details updated.');
    }
}
