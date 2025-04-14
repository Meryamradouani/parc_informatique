<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Affiche le formulaire de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Traite la soumission du formulaire de login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Tenter d'authentifier l'utilisateur
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Condition pour rediriger vers admin.index
        if ($user->email === 'admin@gmail.com' && $request->password === 'admin123') {
            return redirect()->route('admin.index'); // Redirige vers admin.index pour l'admin
        } else {
            return redirect()->intended('utilisateur'); // Redirige vers utilisateur pour un utilisateur normal
        }
    }

    throw ValidationException::withMessages([
        'email' => ['Les informations d\'identification fournies sont incorrectes.'],
    ]);
}
    // Déconnecte l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
