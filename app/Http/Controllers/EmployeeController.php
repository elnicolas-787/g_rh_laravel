<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employee;
use App\Models\FormationEmployee;
use App\Models\Mission;
use App\Models\Profession;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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

        $data['services'] = Service::get();
        $data['professions'] = Profession::get();
        $data['employees'] = Employee::join('professions', 'professions.id', '=', 'employees.professions_id')
            ->join('services', 'services.id', '=', 'employees.services_id')
            ->orderBy('employees.id', 'desc')
            ->select('services.nom_serv', 'professions.nom_prof', 'employees.*')
            ->get();

        return view('pages/employees/employee', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

        $data['services'] = Service::get();
        $data['professions'] = Profession::get();
        return view('pages/employees/add_employee', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_data = $request->validate([
            'immatriculation'=>'required',
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom'=>'required',
            'prenom'=>'required',
            'adresse'=>'required',
            'email'=>'required',
            'date_naiss'=>'required',
            'lieu_naiss'=>'required',
            'cin'=>'required',
            'sexe'=>'required',
            'situation_f'=>'required',
            'telephone'=>'required',
            'service'=>'required',
            'profession'=>'required',
            'num_contrat'=>'required',
            'type_contrat'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'nullable',
            'salaire'=>'required',
            'jour_sem'=>'required',
            'heure_sem'=>'required',
            'horaire'=>'required',
        ]);

        $image = $request->file('photo');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        $nom = $validation_data['nom'];
        $prenom = $validation_data['prenom'];

        // $existFullname = Employee::where('nom', $nom)->orWhere('prenom', $prenom)->first();
        $existEmail = Employee::where('email', $nom)->orWhere('prenom', $prenom)->first();

        if ($existEmail) {
            return response()->json(['message' => 'Ces nom et prénom déja existe'], 201);
        } else {
            $employees = new Employee();
            $employees -> immatriculation = $validation_data['immatriculation'];
            $employees -> photo = $imageName;
            $employees -> nom = $validation_data['nom'];
            $employees -> prenom = $validation_data['prenom'];
            $employees -> adresse = $validation_data['adresse'];
            $employees -> email = $validation_data['email'];
            $employees -> date_naiss = $validation_data['date_naiss'];
            $employees -> lieu_naiss = $validation_data['lieu_naiss'];
            $employees -> cin = $validation_data['cin'];
            $employees -> sexe = $validation_data['sexe'];
            $employees -> situation_f = $validation_data['situation_f'];
            $employees -> telephone = $validation_data['telephone'];
            $employees -> professions_id = $validation_data['profession'];
            $employees -> services_id = $validation_data['service'];

            $employees->save();

            $contrats = new Contrat();
            $contrats -> employees_id = $employees->id;
            $contrats -> num_contrat = $validation_data['num_contrat'];
            $contrats -> type_contrat = $validation_data['type_contrat'];
            $contrats -> date_debut = $validation_data['date_debut'];
            $contrats -> date_fin = $validation_data['date_fin'];
            $contrats -> salaire = $validation_data['salaire'];
            $contrats -> jour_sem = $validation_data['jour_sem'];
            $contrats -> heure_sem = $validation_data['heure_sem'];
            $contrats -> horaire = $validation_data['horaire'];

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
        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->select('conges.*')
            ->get();

        $data['absences'] = Absence::where('decision', '=', 'En attente')
        ->select('absences.*')
        ->get();

        $data['services'] = Service::get();
        $data['professions'] = Profession::get();
        $data['employee'] = Employee::select('employees.*', 'professions.nom_prof', 'services.nom_serv', 'directions.nom_dir')
        ->join('professions', 'employees.professions_id', '=', 'professions.id')
        ->join('services', 'employees.services_id', '=', 'services.id')
        ->join('directions', 'services.direction_id', '=', 'directions.id')
        ->where('employees.id', $id)
        ->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation_data = $request->validate([
            'immatriculation'=>'required',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nom'=>'required',
            'prenom'=>'required',
            'adresse'=>'required',
            'email'=>'required',
            'date_naiss'=>'required',
            'lieu_naiss'=>'required',
            'cin'=>'required',
            'sexe'=>'required',
            'situation_f'=>'required',
            'telephone'=>'required',
            'service'=>'required',
            'profession'=>'required'
        ]);

        $image = $request->file('photo');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        $employees = Employee::find($id);
        $employees -> immatriculation = $validation_data['immatriculation'];
        $employees->photo = $imageName;
        $employees -> nom = $validation_data['nom'];
        $employees -> prenom = $validation_data['prenom'];
        $employees -> adresse = $validation_data['adresse'];
        $employees -> email = $validation_data['email'];
        $employees -> date_naiss = $validation_data['date_naiss'];
        $employees -> lieu_naiss = $validation_data['lieu_naiss'];
        $employees -> cin = $validation_data['cin'];
        $employees -> sexe = $validation_data['sexe'];
        $employees -> situation_f = $validation_data['situation_f'];
        $employees -> telephone = $validation_data['telephone'];
        $employees -> professions_id = $validation_data['profession'];
        $employees -> services_id = $validation_data['service'];

        $employees->save();

        return response()->json(['message' => 'La modification a été succée'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees = Employee::find($id);
        $formation = FormationEmployee::where('employee_id', $id);
        $user = User::where('employees_id', $id);
        $mission = Mission::where('employees_id', $id);
        $contrat = Contrat::where('employees_id', $id);
        if ($user) {
            $user->delete();
        }
        if ($mission) {
            $mission->delete();
        }
        if ($contrat) {
            $contrat->delete();
        }
        if ($formation) {
            $formation->delete();
        }

        $employees->delete();

        return response()->json(['message'=> 'La suppression a été succés']);
    }
}
