<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use App\Models\Formation;
use App\Models\FormationEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
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

        return view('pages/formations/formation', $data);
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
            'theme_formation'=>'required',
            'specialite'=>'required',
            'lieu_formation'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
        ]);

        $formations = new Formation();
        $formations -> theme_formation = $validation_data['theme_formation'];
        $formations -> date_debut = $validation_data['date_debut'];
        $formations -> date_fin = $validation_data['date_fin'];
        $formations -> specialite = $validation_data['specialite'];
        $formations -> lieu_formation = $validation_data['lieu_formation'];

        $formations->save();

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
        $formation = Formation::find($id);

        return response()->json($formation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation_data = $request->validate([
            'theme_formation'=>'required',
            'specialite'=>'required',
            'lieu_formation'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
        ]);

        $formations = Formation::find($id);
        $formations -> theme_formation = $validation_data['theme_formation'];
        $formations -> date_debut = $validation_data['date_debut'];
        $formations -> date_fin = $validation_data['date_fin'];
        $formations -> specialite = $validation_data['specialite'];
        $formations -> lieu_formation = $validation_data['lieu_formation'];

        $formations->save();

        return response()->json(['message' => 'La modification a été succée'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::find($id);
        FormationEmployee::where('formation_id', $id)->delete();

        $formation->delete();

        return response()->json(['message' => 'La suppression a été succée'], 201);
    }
}
