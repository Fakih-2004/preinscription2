<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiplomeController extends Controller
{
    public function index()
    {
        $diplomes = Diplome::with('candidat')->get();
        return view('utilisateur.diplomes.index', compact('diplomes'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('utilisateur.diplomes.create', compact('candidats'));
    }

    public function store(Request $request)
{
    // Validate all input fields including files
    $validated = $request->validate([
        'type_diplome_bac2' => 'required|string',
        'annee_bac2' => 'required|string',  // Must match database column exactly
        'filiere_bac2' => 'required|string',
        'etalissement_bac2' => 'required|string',
        'type_bac3' => 'required|string',
        'annee_bac3' => 'required|string',
        'filiere_bac3' => 'required|string',
        'etablissement_bac3' => 'required|string',
        'candidat_id' => 'required|exists:candidats,id',
        'scan_bac2' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'scan_bac3' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $candidat = Candidat::findOrFail($request->candidat_id);
    $count = Diplome::where('candidat_id', $candidat->id)->count() + 1;

    // Handle BAC+2 file upload
    if ($request->hasFile('scan_bac2')) {
        $fileBac2 = $request->file('scan_bac2');
        $extensionBac2 = $fileBac2->getClientOriginalExtension();
        $filenameBac2 = strtoupper($candidat->CNE)
            . '_' . strtolower(str_replace(' ', '', $candidat->nom))
            . strtolower(str_replace(' ', '', $candidat->prenom))
            . '_bac2_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac2;
        
        $pathBac2 = $fileBac2->storeAs('bac2', $filenameBac2, 'public');
        $validated['scan_bac2'] = $pathBac2;
    }

    // Handle BAC+3 file upload
    if ($request->hasFile('scan_bac3')) {
        $fileBac3 = $request->file('scan_bac3');
        $extensionBac3 = $fileBac3->getClientOriginalExtension();
        $filenameBac3 = strtoupper($candidat->CNE)
            . '_' . strtolower(str_replace(' ', '', $candidat->nom))
            . strtolower(str_replace(' ', '', $candidat->prenom))
            . '_bac3_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac3;
        
        $pathBac3 = $fileBac3->storeAs('bac3', $filenameBac3, 'public');
        $validated['scan_bac3'] = $pathBac3;
    }

    // Create the diploma record with all validated data
    Diplome::create([
        'type_diplome_bac2' => $validated['type_diplome_bac2'],
        'annee_bac2' => $validated['annee_bac2'],  // Ensured this matches database
        'filiere_bac2' => $validated['filiere_bac2'],
        'etalissement_bac2' => $validated['etalissement_bac2'],
        'type_bac3' => $validated['type_bac3'],
        'annee_bac3' => $validated['annee_bac3'],
        'filiere_bac3' => $validated['filiere_bac3'],
        'etablissement_bac3' => $validated['etablissement_bac3'],
        'candidat_id' => $validated['candidat_id'],
        'scan_bac2' => $validated['scan_bac2'],
        'scan_bac3' => $validated['scan_bac3']
    ]);

    return redirect()->route('diplomes.index')->with('success', 'Diplôme ajouté avec succès!');
}
    public function show($id)
    {
        $diplome = Diplome::findOrFail($id);
        return view('diplomes.show', compact('diplome'));
    }

    public function edit($id)
    {
        $diplome = Diplome::findOrFail($id);
        $candidats = Candidat::all();
        return view('.diplomes.edit', compact('diplome', 'candidats'));
    }

    public function update(Request $request, $id)
    {
        $diplome = Diplome::findOrFail($id);
        $data = $request->all();

        // Handle scan_bac2
        if ($request->hasFile('scan_bac2')) {
            if ($diplome->scan_bac2 && Storage::disk('public')->exists($diplome->scan_bac2)) {
                Storage::disk('public')->delete($diplome->scan_bac2);
            }
            $data['scan_bac2'] = $request->file('scan_bac2')->store('bac2', 'public');
        }

        // Handle scan_bac3
        if ($request->hasFile('scan_bac3')) {
            if ($diplome->scan_bac3 && Storage::disk('public')->exists($diplome->scan_bac3)) {
                Storage::disk('public')->delete($diplome->scan_bac3);
            }
            $data['scan_bac3'] = $request->file('scan_bac3')->store('bac3', 'public');
        }

        $diplome->update($data);
        return redirect()->route('diplomes.create');
    }

    public function destroy($id)
    {
        $diplome = Diplome::findOrFail($id);

        // Delete scan files
        if ($diplome->scan_bac2 && Storage::disk('public')->exists($diplome->scan_bac2)) {
            Storage::disk('public')->delete($diplome->scan_bac2);
        }
        if ($diplome->scan_bac3 && Storage::disk('public')->exists($diplome->scan_bac3)) {
            Storage::disk('public')->delete($diplome->scan_bac3);
        }

        $diplome->delete();
        return redirect()->route('diplomes.index');
    }
}
