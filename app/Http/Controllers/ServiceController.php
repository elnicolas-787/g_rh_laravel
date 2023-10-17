<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Service;
use App\Models\Direction;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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

        $data['directions'] = Direction::get();
        $data['services'] = Service::join('directions', 'directions.id', '=', 'services.direction_id')
            ->orderBy('id', 'desc')->get(['directions.code_dir', 'services.*']);
        return view('pages/service', $data);
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
        $validatedData = $request->validate([
            'code_serv' => 'required',
            'nom_serv' => 'required',
            'direction_id' => 'required'
        ]);

        $services = new Service();
        $services->code_serv = $validatedData['code_serv'];
        $services->nom_serv = $validatedData['nom_serv'];
        $services->direction_id = $validatedData['direction_id'];
        $services->save();

        return response()->json(['message' => 'L\'enregistrement a été succée'], 201);
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
        $data['directions'] = Direction::get();
        $data['service'] = Service::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'code_serv' => 'required',
            'nom_serv' => 'required',
            'direction_id' => 'required'
        ]);

        $services = Service::find($id);
        $services->code_serv = $validatedData['code_serv'];
        $services->nom_serv = $validatedData['nom_serv'];
        $services->direction_id = $validatedData['direction_id'];

        $services->save();
        return response()->json(['message' => 'La modification a été succée']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);

        $service->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
