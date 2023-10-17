<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
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
        $data['contrats'] = Contrat::orderBy('id', 'desc')->join('employees', 'employees.id', '=', 'contrats.employees_id')
            ->get(['employees.immatriculation', 'employees.nom', 'employees.prenom', 'contrats.*']);
        return view('pages/contrat', $data);
    }

    public function getEmployeeName($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['nom' => 'Aucun employé trouvé']);
        }
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
            'employee'=>'required',
            'num_contrat'=>'required',
            'type_contrat'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'nullable',
            'salaire'=>'required',
            'jour_sem'=>'required',
            'heure_sem'=>'required',
            'horaire'=>'required'
        ]);

        $num_contrat = $validateData['num_contrat'];

        $existNumContrat = Contrat::where('num_contrat', $num_contrat)->first();

        if ($existNumContrat) {
            return response()->json(['message' => 'Ces N° contrat déja existe'], 201);
        }else{
            $contrats = new Contrat();
            $contrats -> employees_id = $validateData['employee'];
            $contrats -> num_contrat = $validateData['num_contrat'];
            $contrats -> type_contrat = $validateData['type_contrat'];
            $contrats -> date_debut = $validateData['date_debut'];
            $contrats -> date_fin = $validateData['date_fin'];
            $contrats -> salaire = $validateData['salaire'];
            $contrats -> jour_sem = $validateData['jour_sem'];
            $contrats -> heure_sem = $validateData['heure_sem'];
            $contrats -> horaire = $validateData['horaire'];

            $contrats->save();

            return response()->json(['message' => 'L\'enregistrement a été succée'], 201);
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
        $contrat = Contrat::find($id);

        $contrat->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
