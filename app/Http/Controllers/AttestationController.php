<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Candidat;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function index()
    {
        $attestations = Attestation::with('candidat')->get();
        return view('attestations.index', compact('attestations'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('attestations.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'attestation' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'discription' => 'required|string',
            'type_attestation' => 'required|string',
        ]);

        $path = $request->file('attestation')->store('attestations', 'public');

        Attestation::create([
            'candidat_id' => $request->candidat_id,
            'attestation' => $path,
            'discription' => $request->discription,
            'type_attestation' => $request->type_attestation,
        ]);

        return redirect()->route('attestations.index')->with('success', 'Attestation ajoutée avec succès.');
    }
    
    public function edit($id)
    {
        $attestation = Attestation::findOrFail($id);
        $candidats = Candidat::all();
        return view('attestations.edit', compact('attestation', 'candidats'));
    }

   

    public function destroy($id)
    {
        $attestation = Attestation::findOrFail($id);
        $attestation->delete();
        return redirect()->route('attestations.index')->with('success', 'Attestation supprimée avec succès.');
    }
}
