<?php

namespace App\Http\Controllers;

use App\Models\User; // Changed from Administrateur to User
use Illuminate\Http\Request;

class UserController extends Controller // Changed from AdministrateurController to UserController
{
    public function index()
    {
        $users = User::all(); // Changed variable name from administrateurs to users
        return view('utilisateur.administrateurs.index', compact('users')); // Changed view path and variable
    }

    public function create()
    {
        return view('utilisateur.administrateurs.create'); // Changed view path
    }

    public function store(Request $request)
    {
        User::create($request->all()); // Changed model
        return redirect()->route('administrateurs.index'); // Changed route name
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Changed variable name and model
        return view('utilisateur.administrateurs.edit', compact('user')); // Changed view path and variable
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Changed variable name and model
        $user->update($request->all());
        return redirect()->route('administrateurs.index'); // Changed route name
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Changed variable name and model
        $user->delete();
        
        return redirect()->route('administrateurs.index') // Changed route name
            ->with('success', 'Utilisateur supprimé avec succès'); // Changed success message
    }
}