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
    if ($request->hasFile('scan_bac_2')) {
        $fileBac_2 = $request->file('scan_bac_2');
        $extensionBac_2 = $fileBac_2->getClientOriginalExtension();
        $filenameBac_2 = strtoupper($candidat->CNE)
            . '_' . strtolower(str_replace(' ', '', $candidat->nom))
            . strtolower(str_replace(' ', '', $candidat->prenom))
            . '_bac_2_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac_2;
        
        $pathBac_2 = $fileBac_2->storeAs('bac_2', $filenameBac_2, 'public');
        $validated['scan_bac_2'] = $pathBac_2;
    }

        // Handle BAC+3 file upload
        if ($request->hasFile('scan_bac_3')) {
            $fileBac_3 = $request->file('scan_bac_3');
            $extensionBac__3 = $fileBac3->getClientOriginalExtension();
            $filenameBac3 = strtoupper($candidat->CNE)
                . '_' . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_bac_3_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac_3;
            
            $pathBac_3 = $fileBac_3->storeAs('bac_3', $filenameBac_3, 'public');
            $data['scan_bac_3'] = $pathBac_3;
        } else {
            $data['scan_bac_3'] = null;
        }

        // Create the diploma record with all validated data
        Diplome::create([
            'type_diplome_bac_2' => $data['type_diplome_bac_2'],
            'annee_diplome_bac_2' => $data['annee_diplome_bac_2'],
            'filiere_diplome_bac_2' => $data['filiere_diplome_bac_2'],
            'etablissement_bac_2' => $data['etablissement_bac_2'],
            'type_diplome_bac_3' => $data['type_diplome_bac_3'],
            'annee_diplome_bac_3' => $data['annee_diplome_bac_3'],
            'filiere_diplome_bac_3' => $data['filiere_diplome_bac_3'],
            'etablissement_bac_3' => $data['etablissement_bac_3'],
            'candidat_id' => $data['candidat_id'],
            'scan_bac_2' => $data['scan_bac_2'],
            'scan_bac_3' => $data['scan_bac_3'],
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
        if ($request->hasFile('scan_bac_2')) {
            if ($diplome->scan_bac_2 && Storage::disk('public')->exists($diplome->scan_bac_2)) {
                Storage::disk('public')->delete($diplome->scan_bac_2);
            }
            $fileBac_2 = $request->file('scan_bac_2');
            $extensionBac_2 = $fileBac_2->getClientOriginalExtension();
            $filenameBac_2 = strtoupper($candidat->CNE)
                . '_' . strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_bac_2_' . $count . '_' . now()->format('YmdHis') . '.' . $extensionBac_2;
            
            $pathBac_2 = $fileBac_2->storeAs('bac_2', $filenameBac_2, 'public');
            $data['scan_bac_2'] = $pathBac_2;
        } else {
            $data['scan_bac_2'] = $diplome->scan_bac_2 ?? null;
        }

        // Handle BAC+3 file upload
        if ($request->hasFile('scan_bac_3')) {
            if ($diplome->scan_bac_3 && Storage::disk('public')->exists($diplome->scan_bac_3)) {
                Storage::disk('public')->delete($diplome->scan_bac_3);
            }
            $data['scan_bac_3'] = $request->file('scan_bac_3')->store('bac_3', 'public');
        }

        $diplome->update($data);
        return redirect()->route('diplomes.create');
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