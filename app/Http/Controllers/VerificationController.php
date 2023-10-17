<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifierEmail(Request $request)
    {
        $email = $request->input('email');

        // Vérifiez si l'e-mail existe dans la base de données
        $existe = Employee::where('email', $email)->exists();

        return response()->json(['existe' => $existe]);
    }
}
