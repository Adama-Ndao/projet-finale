<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('wp-admin/pages/create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'nullable|string|max:255',
            'datenaiss' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sexe' => 'nullable|string|max:10',
            'password' => 'required|string|min:6',
            'google_id' => 'nullable|string|max:255',
            'google_token' => 'nullable|string|max:255',
        ]);

        // Créer un nouvel utilisateur avec les données validées
        User::create($validatedData);

        return back()
            ->with('success', 'Utilisateur créé avec succès.');
    }
}