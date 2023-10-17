<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employee;
use App\Models\Profession;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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

        $contrats = Contrat::get();
        $data['employeeCDD'] = 0;
        $data['employeeCDI'] = 0;
        $data['minSalaire'] = $contrats->min('salaire');
        $data['maxSalaire'] = $contrats->max('salaire');
        $data['employeeSalaire'] = Contrat::select('salaire', DB::raw('count(*) as nbCount'))
        ->groupBy('salaire')
        ->get();

        foreach ($contrats as $contrat) {
            if ($contrat->type_contrat == 'CDD') {
                $data['employeeCDD']++;
            }
            if ($contrat->type_contrat == 'CDI') {
                $data['employeeCDI']++;
            }
        }

        $data['congeType'] = Conge::where('decision', '=', 'Accepter')->select('type_conge', DB::raw('count(*) as totalConge'))
        ->groupBy('type_conge')
        ->get();

        $employees = Employee::all();
        $data['totalEmployee'] = $employees->count();;
        $data['masculin'] = 0;
        $data['feminin'] = 0;
        $data['celibataire'] = 0;
        $data['marie'] = 0;

        foreach ($employees as $employee) {
            if ($employee->sexe == 'Masculin') {
                $data['masculin']++;
            }
            if ($employee->sexe == 'Féminin') {
                $data['feminin']++;
            }
            if ($employee->situation_f == 'Célibataire') {
                $data['celibataire']++;
            }
            if ($employee->situation_f == 'Marié(e)') {
                $data['marie']++;
            }
        }

        $data['employeeByService'] = $employees->groupBy('services_id')->map(function ($group, $serviceId) {
            $serviceName = Service::find($serviceId)->nom_serv;
            return [
                'nom_serv' => $serviceName,
                'count' => $group->count(),
            ];
        });

        return view('pages.dashboard', $data);
    }
}
