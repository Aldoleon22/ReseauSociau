<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
abstract class Controller
{
  
    public function show()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
        $user = Auth::user();
        $posts = $user->posts; // Récupérer les publications de l'utilisateur

        return view('profile', compact('user', 'posts'));
    }
    public function index()
    {
        $posts = Post::with('user', 'comments')->get();
        return view('blog.index', compact('posts'));
    }
    }

