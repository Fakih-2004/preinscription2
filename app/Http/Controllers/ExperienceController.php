<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Candidat;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('candidat')->get();
        return view('experiences.index', compact('experiences'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('experiences.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'fonction' => 'required|string',
            'secteur_activite' => 'required|string',
            'periode' => 'required|date',
            'attestation' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'etablissement' => 'required|string',
            'discription' => 'required|string',
        ]);

        $path = $request->file('attestation')->store('experiences', 'public');

        Experience::create([
            'candidat_id' => $request->candidat_id,
            'fonction' => $request->fonction,
            'secteur_activite' => $request->secteur_activite,
            'periode' => $request->periode,
            'attestation' => $path,
            'etablissement' => $request->etablissement,
            'discription' => $request->discription,
        ]);

        return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée avec succès.');
    }
}
