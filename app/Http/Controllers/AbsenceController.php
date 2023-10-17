<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        $data['role'] = $user->role;

        $idEmployee = $user->employees_id;
        $data['username'] = $user->name;
        $data['employee'] = Employee::select('employees.*')->where('employees.id', $idEmployee)->first();

        $data['employees'] = Employee::get();
        $data['absences'] = Absence::where('users_id', '=', Auth::user()->id)
            ->join('employees', 'employees.id', '=', 'absences.employees_id')
            ->orderBy('absences.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'employees.immatriculation', 'absences.*')
            ->get();

        return view('pages/absences/demande', $data);
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
        $users = auth()->user();
        $user_id = $users->id;
        $employee = $users->employees_id;

        $decision = "En attente";

        $validate_data = $request->validate([
            'date_debut'=>'required',
            'date_fin'=>'required',
            'heure_depart'=>'required',
            'heure_arrive'=>'required',
            'motif'=>'required',
        ]);

        $absences = new Absence();
        $absences -> users_id = $user_id;
        $absences -> employees_id = $employee;
        $absences -> date_debut = $validate_data['date_debut'];
        $absences -> date_fin = $validate_data['date_fin'];
        $absences -> heure_depart = $validate_data['heure_depart'];
        $absences -> heure_arrive = $validate_data['heure_arrive'];
        $absences -> motif = $validate_data['motif'];
        $absences -> decision = $decision;

        $absences->save();

        return response()->json(['message'=>'Demande a été envoyé']);
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
        $absence = Absence::find($id);

        return response()->json($absence);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'date_debut'=>'required',
            'date_fin'=>'required',
            'heure_depart'=>'required',
            'heure_arrive'=>'required',
            'motif'=>'required',
        ]);

        $absences = Absence::find($id);
        $absences -> date_debut = $validate_data['date_debut'];
        $absences -> date_fin = $validate_data['date_fin'];
        $absences -> heure_depart = $validate_data['heure_depart'];
        $absences -> heure_arrive = $validate_data['heure_arrive'];
        $absences -> motif = $validate_data['motif'];

        $absences->save();

        return response()->json(['message'=>'Demande a été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absence = Absence::find($id);

        $absence->delete();

        return response()->json(['message'=>'Suppression a été succée']);
    }
}
