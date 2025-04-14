<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Facades\URL;

class AdminprofileController extends Controller
{    public function show()
    {
        $user = Auth::user(); // Récupère l'utilisateur authentifié
        return view('profile', compact('user')); // Passe l'utilisateur à la vue
    }
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'tel' => 'nullable|string|max:15',
        'email' => 'required|string|email|max:255|unique:utilisateur,email,' . $user->id_utilisateur . ',id_utilisateur',
        'fonctionalite' => 'required|string|max:50',
        'current_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:6|confirmed',
    ]);

    // Update user details
    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->tel = $request->tel;
    $user->email = $request->email;
    $user->fonctionalite = $request->fonctionalite;

    // Check and update password
    if ($request->current_password && Hash::check($request->current_password, $user->password)) {
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
}

}
