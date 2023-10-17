<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use App\Models\Formation;
use App\Models\FormationEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Js;

class FormationEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data['role'] = $user->role;

        $idEmployee = $user->employees_id;
        $data['username'] = $user->name;
        $data['employee'] = Employee::select('employees.*')->where('employees.id', $idEmployee)->first();

        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->select('conges.*')
            ->get();

        $data['absences'] = Absence::where('decision', '=', 'En attente')
        ->select('absences.*')
        ->get();

        $data['formations'] = Formation::orderBy('id', 'desc')->get();
        $data['employees'] = Employee::get();
        $data['formation_employees'] = FormationEmployee::join('formations', 'formations.id', '=', 'formation_employees.formation_id')
            ->join('employees', 'employees.id', '=', 'formation_employees.employee_id')
            ->orderBy('formation_employees.id', 'desc')
            ->select('formations.theme_formation', 'formations.date_debut', 'formations.date_fin', 'employees.immatriculation', 'employees.nom', 'employees.prenom', 'formation_employees.*')
            ->get();

        return view('pages/formations/conservation', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_data = $request->validate([
            'formation'=>'required',
            'employee'=>'required',
        ]);

        $conservations = new FormationEmployee();
        $conservations -> formation_id = $validation_data['formation'];
        $conservations -> employee_id = $validation_data['employee'];

        $conservations->save();

        return response()->json(['message' => 'L\'enregistrement a été succée'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $echelon = FormationEmployee::find($id);

        $echelon->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
