<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::with('candidat')->get();
        return view('utilisateur.stages.index', compact('stages'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('utilisateur.stages.create', compact('candidats'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'candidat_id' => 'required|exists:candidats,id',
        'fonction' => 'required|string',
        'periode' => 'required|string',
        'attestation' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'etablissement' => 'required|string',
        'secteur_activite' => 'required|string',
        'discription' => 'required|string',
    ]);

    $candidat = Candidat::findOrFail($request->candidat_id);

    if ($request->hasFile('attestation')) {
        // Count how many stages this candidate already has
        $count = Stage::where('candidat_id', $candidat->id)->count() + 1;

        $file = $request->file('attestation');
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('YmdHis');

        $filename = strtoupper($candidat->CNE)
            . strtolower(str_replace(' ', '', $candidat->nom))
            . strtolower(str_replace(' ', '', $candidat->prenom))
            . '_stage_' . $count . '_' . $timestamp . '.' . $extension;

        $path = $file->storeAs('stages', $filename, 'public');
        $validated['attestation'] = $path;
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
            'attestation' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'etablissement' => 'required|string',
            'secteur_activite' => 'required|string',
            'discription' => 'required|string',
        ]);
    
        $candidat = Candidat::findOrFail($request->candidat_id);
    
        if ($request->hasFile('attestation')) {
            // Delete old file if exists
            if ($stage->attestation && \Storage::disk('public')->exists($stage->attestation)) {
                \Storage::disk('public')->delete($stage->attestation);
            }
    
            $count = Stage::where('candidat_id', $candidat->id)
                ->where('id', '!=', $stage->id)
                ->count() + 1;
    
            $file = $request->file('attestation');
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
    
            $filename = strtoupper($candidat->CNE)
                . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_stage_' . $count . '_' . $timestamp . '.' . $extension;
    
            $path = $file->storeAs('attestations', $filename, 'public');
            $validated['attestation'] = $path;
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
