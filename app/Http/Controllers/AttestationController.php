<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttestationController extends Controller
{
    public function index()
    {
        $attestations = Attestation::with('candidat')->get();
        return view('utilisateur.attestations.index', compact('attestations'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('utilisateur.attestations.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'attestation' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'description' => 'required|string',
            'type_attestation' => 'required|string',
        ]);
    
        $candidat = Candidat::findOrFail($request->candidat_id);
    
        
        if ($request->hasFile('attestation')) {
            $count = Attestation::where('candidat_id', $candidat->id)->count() + 1;
    
            $file = $request->file('attestation');
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
    
            $filename = strtoupper($candidat->CNE)
                . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . 'attestation' . $count . '_' . $timestamp . '.' . $extension;
    
            $path = $file->storeAs('attestations', $filename, 'public');
            $validated['attestation'] = $path;
        }
    
        Attestation::create($validated);
    
        return redirect()->route('attestations.index')->with('success', 'Attestation ajoutée avec succès.');
    }
    

    public function update(Request $request, $id)
{
    $request->validate([
        'candidat_id' => 'required|exists:candidats,id',
        'attestation' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'description' => 'string',
        'type_attestation' => 'required|string',
    ]);

    $attestation = Attestation::findOrFail($id);
    $candidat = Candidat::findOrFail($request->candidat_id);

    if ($request->hasFile('attestation')) {
        if ($attestation->attestation && \Storage::disk('public')->exists($attestation->attestation)) {
            \Storage::disk('public')->delete($attestation->attestation);
        }

        $count = Attestation::where('candidat_id', $candidat->id)
            ->where('type_attestation', $request->type_attestation)
            ->where('id', '!=', $attestation->id)
            ->count() + 1;

        $file = $request->file('attestation');
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->format('YmdHis');

        $filename = strtoupper($candidat->CNE)
            . strtolower(str_replace(' ', '', $candidat->nom))
            . strtolower(str_replace(' ', '', $candidat->prenom))
            . '_' . strtolower($request->type_attestation)
            . '_' . $count
            . '_' . $timestamp
            . '.' . $extension;

        $path = $file->storeAs('attestations', $filename, 'public');
        $attestation->attestation = $path;
    }

    $attestation->candidat_id = $request->candidat_id;
    $attestation->description = $request->description;
    $attestation->type_attestation = $request->type_attestation;
    $attestation->save();

    return redirect()->route('attestations.index')->with('success', 'Attestation modifiée avec succès.');
}

    
    public function edit($id)
    {
        $attestation = Attestation::findOrFail($id);
        $candidats = Candidat::all();
        return view('utilisateur.attestations.edit', compact('attestation', 'candidats'));
    }

   

    public function destroy($id)
    {
        $attestation = Attestation::findOrFail($id);
        $attestation->delete();
        return redirect()->route('attestations.index')->with('success', 'Attestation supprimée avec succès.');
    }
}
