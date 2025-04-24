<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Administrateur;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        $administrateurs = Administrateur::all();
        return view('formations.create', compact('administrateurs'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_formation' => 'required|string' ,
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'administrateur_id' => 'required|exists:administrateurs,id',
        ]);
       
    
        Formation::create($validated);
        return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
    }
    

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.show', compact('formation'));
    }

    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.edit', compact('formation'));
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->update($request->all());
        return redirect()->route('formations.index');
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('formations.index');
    }
}
