<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Stocker la nouvelle image
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
            $user->save();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Photo de profil mise à jour avec succès');
    }
}
