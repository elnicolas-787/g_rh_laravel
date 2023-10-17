<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Categorie;
use App\Models\Conge;
use App\Models\Echelon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EchelonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        $data['role'] = $user->role;

        $data['conges'] = Conge::where('decision', '=', 'En attente')
            ->select('conges.*')
            ->get();

        $data['absences'] = Absence::where('decision', '=', 'En attente')
        ->select('absences.*')
        ->get();

        $data['categories'] = Categorie::get();
        $data['echelons'] = Echelon::orderBy('id', 'desc')->join('categories', 'categories.id', '=', 'echelons.categorie_id')
            ->get(['categories.code_cat', 'echelons.*']);
        return view('pages/echelon', $data);
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
            'code_echelon' => 'required',
            'categorie_id' => 'required'
        ]);

        $echelons = new Echelon();
        $echelons->code_echelon = $validateData['code_echelon'];
        $echelons->categorie_id = $validateData['categorie_id'];

        $echelons->save();

        return response()->json(['message' => 'L\'enregistrement a été succée']);
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
        $data['categories'] = Categorie::get();
        $data['echelon'] = Echelon::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'code_echelon' => 'required',
            'categorie_id' => 'required'
        ]);

        $echelons = Echelon::find($id);
        $echelons->code_echelon = $validateData['code_echelon'];
        $echelons->categorie_id = $validateData['categorie_id'];

        $echelons->save();

        return response()->json(['message' => 'La modification a été succée']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $echelon = Echelon::find($id);

        $echelon->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
