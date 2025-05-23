<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiplomeRequest;
use App\Models\Diplome;
use App\Models\Candidat;
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

    public function store(StoreDiplomeRequest $request)
    {
        $candidat = Candidat::findOrFail($request->candidat_id);
        $count = Diplome::where('candidat_id', $candidat->id)->count() + 1;

        $data = $request->all();

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
            $data['scan_bac3'] = $pathBac3;
        } else {
            $data['scan_bac3'] = null;
        }

        // Create the diploma record with all validated data
        Diplome::create([
            'type_diplome_bac2' => $data['type_diplome_bac2'],
            'annee_bac2' => $data['annee_bac2'],
            'filiere_bac2' => $data['filiere_bac2'],
            'etablissement_bac2' => $data['etablissement_bac2'],
            'type_bac3' => $data['type_bac3'],
            'annee_bac3' => $data['annee_bac3'],
            'filiere_bac3' => $data['filiere_bac3'],
            'etablissement_bac3' => $data['etablissement_bac3'],
            'candidat_id' => $data['candidat_id'],
            'scan_bac2' => $data['scan_bac2'],
            'scan_bac3' => $data['scan_bac3'],
        ]);

        return redirect()->route('diplomes.index')->with('success', 'Diplôme ajouté avec succès!');
    }

    public function show($id)
    {
        $diplome = Diplome::findOrFail($id);
        return view('utilisateur.diplomes.show', compact('diplome')); // Fixed view path
    }

    public function edit($id)
    {
        $diplome = Diplome::findOrFail($id);
        $candidats = Candidat::all();
        return view('utilisateur.diplomes.edit', compact('diplome', 'candidats'));
    }

    public function update(StoreDiplomeRequest $request, $id)
    {
        $diplome = Diplome::findOrFail($id);
        $candidat = Candidat::findOrFail($diplome->candidat_id);
        $count = Diplome::where('candidat_id', $candidat->id)->count();

        $data = $request->all();

        // Handle BAC+2 file upload
        if ($request->hasFile('scan_bac2')) {
            if ($diplome->scan_bac2 && Storage::disk('public')->exists($diplome->scan_bac2)) {
                Storage::disk('public')->delete($diplome->scan_bac2);
            }
            $fileBac2 = $request->file('scan_bac2');
            $extensionBac2 = $fileBac2->getClientOriginalExtension();
            $filenameBac2 = strtoupper($candidat->CNE)
                . '_' . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_bac2_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac2;
            
            $pathBac2 = $fileBac2->storeAs('bac2', $filenameBac2, 'public');
            $data['scan_bac2'] = $pathBac2;
        } else {
            $data['scan_bac2'] = $diplome->scan_bac2 ?? null;
        }

        // Handle BAC+3 file upload
        if ($request->hasFile('scan_bac3')) {
            if ($diplome->scan_bac3 && Storage::disk('public')->exists($diplome->scan_bac3)) {
                Storage::disk('public')->delete($diplome->scan_bac3);
            }
            $data['scan_bac3'] = $request->file('scan_bac3')->store('bac3', 'public');
        }

        $diplome->update($data);
        return redirect()->route('diplomes.create');
    }
    }
     public function destroy($id)
    {
        $diplome = Diplome::findOrFail($id);

        // Delete scan files
        if ($diplome->scan_bac_2 && Storage::disk('public')->exists($diplome->scan_bac_2)) {
            Storage::disk('public')->delete($diplome->scan_bac_2);
        }
        if ($diplome->scan_bac_3 && Storage::disk('public')->exists($diplome->scan_bac_3)) {
            Storage::disk('public')->delete($diplome->scan_bac_3);
        }

        $diplome->delete();
        return redirect()->route('diplomes.index')->with('success', 'Diplôme supprimé avec succès!');
    }
}