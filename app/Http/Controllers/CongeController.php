<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongeController extends Controller
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

        $data['employees'] = Employee::get();
        $data['conges'] = Conge::where('users_id', '=', Auth::user()->id)
            ->join('employees', 'employees.id', '=', 'conges.employees_id')
            ->orderBy('conges.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'employees.immatriculation', 'conges.*')
            ->get();

        return view('pages/conges/demande', $data);
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
            'duree_conge'=>'required',
            'type_conge'=>'required',
            'motif'=>'required',
        ]);

        $conges = new Conge();
        $conges -> users_id = $user_id;
        $conges -> employees_id = $employee;
        $conges -> date_debut = $validate_data['date_debut'];
        $conges -> date_fin = $validate_data['date_fin'];
        $conges -> duree_conge = $validate_data['duree_conge'];
        $conges -> type_conge = $validate_data['type_conge'];
        $conges -> motif = $validate_data['motif'];
        $conges -> decision = $decision;

        $conges->save();

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
        $conge = Conge::find($id);

        return response()->json($conge);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate_data = $request->validate([
            'date_debut'=>'required',
            'date_fin'=>'required',
            'type_conge'=>'required',
            'motif'=>'required',
        ]);

        $conges = Conge::find($id);
        $conges -> date_debut = $validate_data['date_debut'];
        $conges -> date_fin = $validate_data['date_fin'];
        $conges -> type_conge = $validate_data['type_conge'];
        $conges -> motif = $validate_data['motif'];

        $conges->save();

        return response()->json(['message'=>'Demande a été changé']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conge = Conge::find($id);

        $conge->delete();

        return response()->json(['message'=>'Suppression a été succée']);
    }
}
