<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}


public function sentFriendRequests()
{
    return $this->hasMany(Friendship::class, 'sender_id');
}

// Relations d'amitié reçues
public function receivedFriendRequests()
{
    return $this->hasMany(Friendship::class, 'receiver_id');
}

// Amis

    public function friends()
    {
        $friendsOfMine = $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->withPivot('status')
            ->wherePivot('status', 'accepted',true)
            ->get();

        $friendsOf = $this->belongsToMany(User::class, 'friendships', 'receiver_id', 'sender_id')
            ->withPivot('status')
            ->wherePivot('status', 'accepted', true)
            ->get();

        return $friendsOfMine->merge($friendsOf);
    }
}



