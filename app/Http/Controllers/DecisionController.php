<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecisionController extends Controller
{
    public function actionConge(Request $request, string $id)
    {
        $validateData = $request->validate([
            'decision' => 'required'
        ]);

        $professions = Conge::find($id);
        $professions->decision = $validateData['decision'];

        $professions->save();

        return response()->json(['message' => 'La decision a été succée']);
    }

    public function actionAbsence(Request $request, string $id)
    {
        $validateData = $request->validate([
            'decision' => 'required'
        ]);

        $professions = Absence::find($id);
        $professions->decision = $validateData['decision'];

        $professions->save();

        return response()->json(['message' => 'La decision a été succée']);
    }

    public function getCongeAccepter()
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

        $data['conges_data'] = Conge::where('decision', '=', 'Accepter')
            ->join('employees', 'employees.id', '=', 'conges.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('conges.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'conges.*')
            ->get();
        return view('pages.conges.demande_accepter' ,$data);
    }

    public function getAbsenceAccepter()
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

        $data['absences_data'] = Absence::where('decision', '=', 'Accepter')
            ->join('employees', 'employees.id', '=', 'absences.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('absences.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'absences.*')
            ->get();
        return view('pages.absences.demande_accepter' ,$data);
    }

    public function getCongeRefuser()
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

        $data['conges_data'] = Conge::where('decision', '=', 'Refuser')
            ->join('employees', 'employees.id', '=', 'conges.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('conges.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'conges.*')
            ->get();
        return view('pages.conges.demande_refuser' ,$data);
    }

    public function getAbsenceRefuser()
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

        $data['absences_data'] = Absence::where('decision', '=', 'Refuser')
            ->join('employees', 'employees.id', '=', 'absences.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('absences.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'absences.*')
            ->get();
        return view('pages.absences.demande_refuser' ,$data);
    }
}
