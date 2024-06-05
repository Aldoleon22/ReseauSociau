<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{





    public function index()
    {
        // Récupérer les publications avec les informations de l'utilisateur
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        return view('home', compact('posts'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
}
