<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;

class AdministrateurController extends Controller
{
    public function index()
    {
        $administrateurs = Administrateur::all();
        return view('utilisateur.administrateurs.index', compact('administrateurs'));
    }

    public function create()
    {
        return view('utilisateur.administrateurs.create');
    }

    public function store(Request $request)
    {
        Administrateur::create($request->all());
        return redirect()->route('utilisateur.administrateurs.index');
    }

    public function show($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        return view('utilisateur.administrateurs.show', compact('administrateur'));
    }

    public function edit($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        return view('utilisateur.administrateurs.edit', compact('administrateur'));
    }

    public function update(Request $request, $id)
    {
        $administrateur = Administrateur::findOrFail($id);
        $administrateur->update($request->all());
        return redirect()->route('utilisateur.administrateurs.index');
    }

    public function destroy($id)
    {
        $administrateur = Administrateur::findOrFail($id);
        $administrateur->delete();
        return redirect()->route('utilisateur.administrateurs.index');
    }
}
