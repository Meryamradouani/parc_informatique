<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:12',
            'prenom' => 'required|string|max:12',

            'email' => 'required|string|email|max:255|unique:utilisateur,email',
            'password' => 'required|string|min:8|confirmed',
            

        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),


        ]);

        return redirect()->route('index')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }
}
