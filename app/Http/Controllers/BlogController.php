<?php
namespace App\Http\Controllers;

use App\Http\Requests\BlogFiltreRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        // Valider les données de la requête entrante
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        // Créer une nouvelle instance de Post et la sauvegarder en base de données
        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['title'],
            'image_path' => $imagePath,
        ]);

        // Rediriger vers la page de détails
        return redirect()->route('blog.index', ['slug' => $post->slug, 'post' => $post->id])->with('success', "La publication a bien été sauvegardée");
    }

    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $request)
    {
        // Valider les données de la requête entrante
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $post->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        // Mettre à jour les données du post
        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['title'],
            'image_path' => $imagePath,
        ]);

        // Synchroniser les tags si nécessaire
        // $post->tags()->sync($request->input('tags', []));

        return redirect()->route('blog.index', ['slug' => $post->slug, 'post' => $post->id])->with('success', "La publication a bien été modifiée");
    }

    public function index(): View
    {
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug, string $post): RedirectResponse | View
    {
        $post = Post::findOrFail($post);
        if ($post->slug != $slug) {
            return redirect()->route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }
}
