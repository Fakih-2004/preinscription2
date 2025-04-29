<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Candidat;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::with('candidat')->get();
        return view('stages.index', compact('stages'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('stages.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'fonction' => 'required|string',
            'periode' => 'required|date',
            'attestation' => 'nullable|file|mimes:pdf,jpg,png',
            'etablissement' => 'required|string',
            'secteur_activite' => 'required|string',
            'discription' => 'required|string',
        ]);

        if ($request->hasFile('attestation')) {
            $validated['attestation'] = $request->file('attestation')->store('public/attestations');
        }

        Stage::create($validated);
        return redirect()->route('stages.index')->with('success', 'Stage ajouté avec succès.');
    }

    public function edit($id)
    {
        $stage = Stage::findOrFail($id);
        $candidats = Candidat::all();
        return view('stages.edit', compact('stage', 'candidats'));
    }

    public function update(Request $request, $id)
    {
        $stage = Stage::findOrFail($id);

        $validated = $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'fonction' => 'required|string',
            'periode' => 'required|date',
            'attestation' => 'nullable|file|mimes:pdf,jpg,png',
            'etablissement' => 'required|string',
            'secteur_activite' => 'required|string',
            'discription' => 'required|string',
        ]);

        if ($request->hasFile('attestation')) {
            $validated['attestation'] = $request->file('attestation')->store('public/attestations');
        }

        $stage->update($validated);
        return redirect()->route('stages.index')->with('success', 'Stage modifié avec succès.');
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return redirect()->route('stages.index')->with('success', 'Stage supprimé.');
    }
}
