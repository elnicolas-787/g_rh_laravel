<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
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
        $data['users'] = User::join('employees', 'employees.id', '=', 'users.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->select('users.*', 'employees.email', 'professions.nom_prof', 'employees.immatriculation')
            ->orderBy('users.id', 'desc')
            ->get();

        return view('pages.utilisateur', $data);
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
        $validate_data = $request->validate([
            'employee'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);

        $nom_user = $validate_data['name'];

        $existUsername = User::where('name', $nom_user)->first();

        if ($existUsername) {
            return response()->json(['message' => 'Ces nom d\'utilisateur déja existe.'], 201);
        } else {
            $utilisateurs = new User();
            $utilisateurs -> employees_id = $validate_data['employee'];
            $utilisateurs -> name = $validate_data['name'];
            $utilisateurs -> email = $validate_data['email'];
            $utilisateurs -> password = bcrypt($validate_data['password']);
            $utilisateurs->save();

            return response()->json(['message'=> 'Création du compte a été succée'], 201);
        }
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
        $user = User::find($id);

        $user -> delete();

        return response()->json(['message'=> 'La suppression d\'une compte a été succée']);
    }
}
