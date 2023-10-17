<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index() {
        $data['employees'] = Employee::get();
        return view('pages.auth.login', $data);
    }

    public function registre() {
        return view('pages.auth.registre');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $checkLogin = $request->only('email', 'password');

        if (Auth::attempt($checkLogin)) {
            return redirect('tableau_de_bord')->withSuccess('Succées');
        }

        return redirect('/')->withSuccess('Succées');
    }
}
