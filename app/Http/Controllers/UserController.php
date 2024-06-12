<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    

    // Méthode pour afficher la liste des utilisateurs
    public function index()
    {
        $userId = Auth::id();

        $users = User::where('id', '!=', $userId)->get();

        // Récupérez les amis et les demandes en attente
        $friends = Auth::user()->friends()->pluck('id')->toArray();
        $pendingRequests = Auth::user()->sentFriendRequests()->where('status', 'pending')->pluck('receiver_id')->toArray();

        return view('users.index', compact('users', 'friends', 'pendingRequests'));
    
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users.index', compact('users'));
    }

    public function friends()
    {
        {      $user = Auth::user();
            $userId = $user->id;
    
            // Récupérer les amis
            $friends = User::whereHas('receivedFriendRequests', function ($query) use ($userId) {
                $query->where('status', 'accepted')
                      ->where('sender_id', $userId);
            })->orWhereHas('sentFriendRequests', function ($query) use ($userId) {
                $query->where('status', 'accepted')
                      ->where('receiver_id', $userId);
            })->get();
    
        
            return view('friends', compact('friends'));
        }
        }

    
}
