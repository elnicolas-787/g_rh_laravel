<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectionController extends Controller
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

        $data['directions'] = Direction::orderBy('id', 'desc')->get();
        return view('pages/direction', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code_dir' => 'required',
            'nom_dir' => 'required',
        ]);

        $code_dir = $validatedData['code_dir'];
        $nom_dir = $validatedData['nom_dir'];

        $existingDirection = Direction::where('code_dir', $code_dir)->orWhere('nom_dir', $nom_dir)->first();

        if ($existingDirection) {
            return response()->json(['message' => 'Ces données existent déjà.'], 201);
        } else {
            $direction = new Direction();
            $direction->code_dir = $code_dir;
            $direction->nom_dir = $nom_dir;
            $direction->save();
        }

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
        $direction = Direction::find($id);
        return response()->json($direction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'code_dir' => 'required',
            'nom_dir' => 'required',
        ]);

        $direction = Direction::find($id);
        $direction->code_dir = $validatedData['code_dir'];
        $direction->nom_dir = $validatedData['nom_dir'];

        $direction->save();
        return response()->json(['message' => 'La modification a été succée']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $direction = Direction::findOrFail($id);
        Service::where('direction_id', $id)->delete();

        $direction->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
