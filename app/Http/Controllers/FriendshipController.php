<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function sendRequest($receiverId)
    {
        $senderId = Auth::id();
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
        if ($friendship && $friendship->receiver_id == Auth::id()) {
            $friendship->update(['status' => 'accepted']);
            return redirect()->back()->with('success', 'Invitation acceptée.');
        }

        return redirect()->back()->with('error', 'Erreur lors de l\'acceptation de l\'invitation.');
    }

    public function declineRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);
        if ($friendship && $friendship->receiver_id == Auth::id()) {
            $friendship->update(['status' => 'declined']);
            return redirect()->back()->with('success', 'Invitation refusée.');
        }

        return redirect()->back()->with('error', 'Erreur lors du refus de l\'invitation.');
    }
    
    public function pendingRequests()
    {
        $userId = Auth::id();
        $pendingRequests = Friendship::where('receiver_id', $userId)
                                      ->where('status', 'pending')
                                      ->with('sender')
                                      ->get();

        return view('friend_requests', compact('pendingRequests'));
    }
}

