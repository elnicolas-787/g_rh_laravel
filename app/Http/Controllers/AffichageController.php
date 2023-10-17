<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AffichageController extends Controller
{
    public function getAllEmployee()
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

        $data['contrats'] = Contrat::join('employees', 'employees.id', '=', 'contrats.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('contrats.id', 'desc')
            ->select('employees.*', 'professions.nom_prof', 'contrats.*')
            ->get();
        return view('pages.listes.affichage_toutes_employee' ,$data);
    }

    public function getContratCdd()
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

        $data['contrats'] = Contrat::where('type_contrat', '=', 'CDD')
            ->join('employees', 'employees.id', '=', 'contrats.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('contrats.id', 'desc')
            ->select('employees.*', 'professions.nom_prof', 'contrats.*')
            ->get();
        return view('pages.listes.affichage_cdd' ,$data);
    }

    public function getContratCdi()
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

        $data['contrats'] = Contrat::where('type_contrat', '=', 'CDI')
            ->join('employees', 'employees.id', '=', 'contrats.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('contrats.id', 'desc')
            ->select('employees.*', 'professions.nom_prof', 'contrats.*')
            ->get();
        return view('pages.listes.affichage_cdi' ,$data);
    }

    public function getAnneeService() {
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

        $data['contrats'] = DB::table('contrats')
            ->join('employees', 'employees.id', '=', 'contrats.employees_id')
            ->join('professions', 'professions.id', '=', 'employees.professions_id')
            ->orderBy('contrats.id', 'desc')
            ->select('employees.*', 'professions.nom_prof', 'contrats.*')
            ->selectRaw('DATEDIFF(NOW(), contrats.date_debut) AS service_age_in_days')
            ->whereRaw('DATEDIFF(NOW(), contrats.date_debut) > 1825')
            ->get();

        return view('pages.listes.affichage_cinq_plus' ,$data);
    }
}
