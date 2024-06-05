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


public function receivedFriendships()
{
    return $this->hasMany(Friendship::class, 'receiver_id');
}

public function friends()
{
    return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
                 return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
                ->withTimestamps();
}

}


