<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['title'],
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('blog.index')->with('success', "La publication a bien été sauvegardée");
    }

    public function index()
    {
        $posts = Post::with('user')->get();
        return view('blog.index', compact('posts'));
   
    
        $posts = Post::with('user', 'comments')->get();
        return view('blog.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $post->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['title'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('blog.index')->with('success', "La publication a bien été modifiée");
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('blog.index')->with('success', "La publication a bien été supprimée");
    }
    public function storeComment(Request $request, $postId)
{
    $request->validate([
        'content' => 'required',
    ]);

    $comment = new Comment();
    $comment->content = $request->input('content');
    $comment->user_id = Auth::id();
    $comment->post_id = $postId;
    $comment->save();

    return redirect()->route('blog.index')->with('success', 'Commentaire ajouté avec succès');
}

}
