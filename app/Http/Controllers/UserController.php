<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  
    

    // Méthode pour afficher la liste des utilisateurs
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users.index', compact('users'));
    }

    // Méthode pour afficher la liste des amis
    public function friends()
    {
        $user = Auth::user();
        $friends = $user->friends; // Appel à la méthode friends du modèle User
        return view('users.friends', compact('friends'));
    }
}

