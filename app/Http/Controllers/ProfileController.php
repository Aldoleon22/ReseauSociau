<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edite', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('profile.edit', $user->id)->with('success', 'Profil mis à jour avec succès');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Supprimer la photo de profil si elle existe
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Supprimer l'utilisateur
        $user->delete();

        return redirect('/login')->with('success', 'Profil supprimé avec succès');
    }
}
