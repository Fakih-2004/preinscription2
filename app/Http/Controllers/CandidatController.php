<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Inscription;

class CandidatController extends Controller
{
    public function index()
{
    $candidats = Candidat::with('inscriptions.formation')->get();
    return view('candidats.index', compact('candidats'));
}


    public function create()
{
    $formations = Formation::all(); // to populate the select
    return view('candidats.create', compact('formations'));
}



public function store(Request $request)
{
    $candidat = Candidat::create($request->except('formation_id'));

    Inscription::create([
        'candidat_id' => $candidat->id,
        'formation_id' => $request->formation_id,
        'annee' => now(), 
    ]);

    return redirect()->route('candidats.index');
}


    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.show', compact('candidat'));
    }

    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.edit', compact('candidat'));
    }

    public function update(Request $request, $id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->update($request->all());
        return redirect()->route('candidats.index');
    }

    public function destroy($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->delete();
        return redirect()->route('candidats.index');
    }
}
