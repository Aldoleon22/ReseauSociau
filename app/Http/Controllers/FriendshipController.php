<?php
namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 

class FriendshipController extends Controller
{
    public function sendRequest($receiverId)
    {
        $senderId = Auth::id();

        // Vérifier si une demande d'amis existe déjà
        $existingFriendship = Friendship::where('sender_id', $senderId)
                                        ->where('receiver_id', $receiverId)
                                        ->first();

        if (!$existingFriendship) {
            Friendship::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'status' => 'pending'
            ]);

            return redirect()->back()->with('success', 'Invitation envoyée avec succès.');
        }

        return redirect()->back()->with('error', 'Invitation déjà envoyée.');
    }

    public function acceptRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);

        // Vérifier si la demande d'amis existe et si l'utilisateur actuel est le destinataire de la demande
        if ($friendship && $friendship->receiver_id == Auth::id()) {
            $friendship->update(['status' => 'accepted']);
            return redirect()->back()->with('success', 'Invitation acceptée.');
        }

        return redirect()->back()->with('error', 'Erreur lors de l\'acceptation de l\'invitation.');
    }

    public function declineRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);

        // Vérifier si la demande d'amis existe et si l'utilisateur actuel est le destinataire de la demande
        if ($friendship && $friendship->receiver_id == Auth::id()) {
            $friendship->update(['status' => 'declined']);
            return redirect()->back()->with('success', 'Invitation refusée.');
        }

        return redirect()->back()->with('error', 'Erreur lors du refus de l\'invitation.');
    }

    public function pendingRequests()
    {
        $userId = Auth::id();

        // Récupérer les demandes d'amis en attente avec les informations sur l'expéditeur
        $pendingRequests = Friendship::where('receiver_id', $userId)
                                      ->where('status', 'pending')
                                      ->with('sender')
                                      ->get();

        return view('friend_requests', compact('pendingRequests'));
    }

  
}
