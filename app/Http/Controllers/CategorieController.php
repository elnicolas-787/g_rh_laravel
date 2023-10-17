<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Echelon;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::orderBy('id', 'desc')->get();

        return view('pages/categorie')->with(compact('categories'));
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
            'code_cat'=>'required',
            'classe_cat'=>'required',
        ]);

        $categories = new Categorie();
        $categories->code_cat = $validateData['code_cat'];
        $categories->classe_cat = $validateData['classe_cat'];

        $categories->save();

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
        $categorie = Categorie::find($id);

        return response()->json($categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'code_cat'=>'required',
            'classe_cat'=>'required',
        ]);

        $categories = Categorie::find($id);
        $categories->code_cat = $validateData['code_cat'];
        $categories->classe_cat = $validateData['classe_cat'];

        $categories->save();

        return response()->json(['message' => 'La modification a été succée'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = Categorie::find($id);
        Echelon::where('categorie_id', $id)->delete();

        $categorie->delete();

        return response()->json(['message' => 'La suppression a été succée']);
    }
}
