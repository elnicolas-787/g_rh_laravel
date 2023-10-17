<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
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

        $data['employees'] = Employee::get();
        $data['missions'] = Mission::join('employees', 'employees.id', '=', 'missions.employees_id')
            ->select('employees.immatriculation', 'employees.nom', 'employees.prenom', 'missions.*')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages/mission', $data);
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
        $validationData = $request->validate([
            'titre'=>'required',
            'description'=>'required',
            'lieu_mission'=>'required',
            'employee'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
        ]);

        $missions = new Mission();
        $missions -> titre = $validationData['titre'];
        $missions -> description = $validationData['description'];
        $missions -> employees_id = $validationData['employee'];
        $missions -> lieu = $validationData['lieu_mission'];
        $missions -> date_debut = $validationData['date_debut'];
        $missions -> date_fin = $validationData['date_fin'];

        $missions->save();

        return response()->json(['message', 'L\'enregistrement a été succés']);
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
        $data['employees'] = Employee::get();
        $data['mission'] = Mission::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validationData = $request->validate([
            'titre'=>'required',
            'description'=>'required',
            'lieu_mission'=>'required',
            'employee'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
        ]);

        $missions = Mission::find($id);
        $missions -> titre = $validationData['titre'];
        $missions -> description = $validationData['description'];
        $missions -> employees_id = $validationData['employee'];
        $missions -> lieu = $validationData['lieu_mission'];
        $missions -> date_debut = $validationData['date_debut'];
        $missions -> date_fin = $validationData['date_fin'];

        $missions->save();

        return response()->json(['message', 'La modification a été succés']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mission = Mission::find($id);

        $mission->delete();

        return response()->json(['message', 'La suppression a été supprimé']);
    }
}
