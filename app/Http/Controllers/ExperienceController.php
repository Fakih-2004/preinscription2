<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('candidat')->get();
        return view('utilisateur.experiences.index', compact('experiences'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('utilisateur.experiences.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'fonction' => 'required|string',
            'secteur_activite' => 'required|string',
            'periode' => 'required',
            'attestation' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'etablissement' => 'required|string',
            'discription' => 'required|string',
        ]);
        $candidat = Candidat::findOrFail($request->candidat_id);

        if ($request->hasFile('attestation')) {
            $count = Experience::where('candidat_id', $candidat->id)->count() + 1;
    
            $file = $request->file('attestation');
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
    
            $filename = strtoupper($candidat->CNE)
                . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . 'experiences' . $count . '_' . $timestamp . '.' . $extension;
    
            $path = $file->storeAs('experiences', $filename, 'public');
            $validated['attestation'] = $path;
        }
    
        Experience::create($validated);
        return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée avec succès.');
    }
}
