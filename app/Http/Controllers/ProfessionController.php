<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
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

        $data['professions'] = Profession::orderBy('id', 'desc')->get();
        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->select('conges.*')
            ->get();

        $data['absences'] = Absence::where('decision', '=', 'En attente')
        ->select('absences.*')
        ->get();

        return view('pages/profession', $data);
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
        $validateData = $request->validate([
            'code_prof' => 'required',
            'nom_prof' => 'required'
        ]);

        $professions = new Profession();
        $professions->code_prof = $validateData['code_prof'];
        $professions->nom_prof = $validateData['nom_prof'];

        $professions->save();

        return response()->json(['message' => 'L\'enregistrement a été succée']);
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
        $profession = Profession::find($id);

        return response()->json($profession);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'code_prof' => 'required',
            'nom_prof' => 'required'
        ]);

        $professions = Profession::find($id);
        $professions->code_prof = $validateData['code_prof'];
        $professions->nom_prof = $validateData['nom_prof'];

        $professions->save();

        return response()->json(['message' => 'La modification a été succée']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profession = Profession::find($id);

        $profession->delete();

        return response()->json(['message' => 'Suppression a été succée']);
    }
}
