<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionCongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllAbsence()
    {
        $user = Auth::user();
        $data['role'] = $user->role;

        $idEmployee = $user->employees_id;
        $data['username'] = $user->name;
        $data['employee'] = Employee::select('employees.*')->where('employees.id', $idEmployee)->first();

        $data['employees'] = Employee::get();
        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->select('conges.*')
            ->get();
        $data['absences'] = Absence::where('decision', '=', 'En attente')
            ->join('employees', 'employees.id', '=', 'absences.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('absences.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'absences.*')
            ->get();

        return view('pages.absences.boite_reception', $data);
    }

    public function getAllConge()
    {
        $user = Auth::user();
        $data['role'] = $user->role;

        $idEmployee = $user->employees_id;
        $data['username'] = $user->name;
        $data['employee'] = Employee::select('employees.*')->where('employees.id', $idEmployee)->first();

        $data['employees'] = Employee::get();
        $data['absences'] = Absence::where('decision', '=', 'En attente')
            ->select('absences.*')
            ->get();
        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->join('employees', 'employees.id', '=', 'conges.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('conges.id', 'desc')
            ->select('employees.nom', 'employees.prenom', 'professions.nom_prof', 'employees.immatriculation', 'conges.*')
            ->get();

        return view('pages.conges.boite_reception', $data);
    }
}
