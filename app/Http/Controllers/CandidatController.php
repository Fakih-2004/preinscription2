<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidatRequest;
use App\Models\Candidat;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Support\Facades\Storage;

class CandidatController extends Controller
{
    public function index()
    {
        $candidats = Candidat::with([
            'stages',
            'attestations',
            'diplomes',
            'experiences',
            'inscriptions.formation'
        ])->get();        
        return view('utilisateur.candidats.index', compact('candidats'));
    }

    public function create()
    {
       
        $currentDate = now()->toDateString(); 

        $formations = Formation::where('date_debut', '<=', $currentDate)
                               ->where('date_fin', '>=', $currentDate)
                               ->get();

        return view('utilisateur.candidats.create', compact('formations'));
    }
      

    public function store(StoreCandidatRequest $request)
    {
        $data = $request->except('formation_id');

    $baseName = strtoupper($request->CNE) . strtolower(str_replace(' ', '', $request->nom)) . strtolower(str_replace(' ', '', $request->prenom));
    $timestamp = now()->format('YmdHis');

    if ($request->hasFile('CV')) {
        $CVExtension = $request->file('CV')->getClientOriginalExtension();
        $CVName = $baseName . '_CV_' . $timestamp . '.' . $CVExtension;
        $data['CV'] = $request->file('CV')->storeAs('CV', $CVName, 'public');
    }

        // Handle demande file
        if ($request->hasFile('demande')) {
            $demandeExtension = $request->file('demande')->getClientOriginalExtension();
            $demandeName = $baseName . '_demande_' . $timestamp . '.' . $demandeExtension;
            $data['demande'] = $request->file('demande')->storeAs('demande', $demandeName, 'public');
        } else {
            $data['demande'] = null;
        }

        // Handle scan_cartid file
        if ($request->hasFile('scan_cartid')) {
            $cinExtension = $request->file('scan_cartid')->getClientOriginalExtension();
            $cinName = $baseName . '_cin_' . $timestamp . '.' . $cinExtension;
            $data['scan_cartid'] = $request->file('scan_cartid')->storeAs('cart', $cinName, 'public');
        } else {
            $data['scan_cartid'] = null;
        }

        // Handle photo file
        if ($request->hasFile('photo')) {
            $photoExtension = $request->file('photo')->getClientOriginalExtension();
            $photoName = $baseName . '_photo_' . $timestamp . '.' . $photoExtension;
            $data['photo'] = $request->file('photo')->storeAs('photos', $photoName, 'public');
        } else {
            $data['photo'] = null;
        }

        // Handle scan_bac file
        if ($request->hasFile('scan_bac')) {
            $bacExtension = $request->file('scan_bac')->getClientOriginalExtension();
            $bacName = $baseName . '_bac_' . $timestamp . '.' . $bacExtension;
            $data['scan_bac'] = $request->file('scan_bac')->storeAs('bac', $bacName, 'public');
        } else {
            $data['scan_bac'] = null;
        }

        $candidat = Candidat::create($data);

        Inscription::create([
            'candidat_id' => $candidat->id,
            'formation_id' => $request->formation_id,
            'annee' => now(),
        ]);

        return redirect()->route('diplomes.create')->with('success', 'Candidat ajouté avec succès.');
    }

    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        $formations = Formation::all();
        return view('candidats.edit', compact('candidat', 'formations'));
    }

    public function update(StoreCandidatRequest $request, $id)
    {
        $candidat = Candidat::findOrFail($id);
        $data = $request->all();

        $baseName = strtoupper($candidat->CNE) . strtolower(str_replace(' ', '', $candidat->nom)) . strtolower(str_replace(' ', '', $candidat->prenom));
        $timestamp = now()->format('YmdHis');

    if ($request->hasFile('CV')) {
        Storage::delete($candidat->CV);
        $CVExtension = $request->file('CV')->getClientOriginalExtension();
        $CVName = $baseName . '_CV_' . $timestamp . '.' . $CVExtension;
        $data['CV'] = $request->file('CV')->storeAs('CV', $CVName, 'public');
    }

        // Handle demande file
        if ($request->hasFile('demande')) {
            if ($candidat->demande && Storage::exists($candidat->demande)) {
                Storage::delete($candidat->demande);
            }
            $demandeExtension = $request->file('demande')->getClientOriginalExtension();
            $demandeName = $baseName . '_demande_' . $timestamp . '.' . $demandeExtension;
            $data['demande'] = $request->file('demande')->storeAs('demande', $demandeName, 'public');
        } else {
            $data['demande'] = $candidat->demande ?? null;
        }

        // Handle scan_cartid file
        if ($request->hasFile('scan_cartid')) {
            if ($candidat->scan_cartid && Storage::exists($candidat->scan_cartid)) {
                Storage::delete($candidat->scan_cartid);
            }
            $cinExtension = $request->file('scan_cartid')->getClientOriginalExtension();
            $cinName = $baseName . '_cin_' . $timestamp . '.' . $cinExtension;
            $data['scan_cartid'] = $request->file('scan_cartid')->storeAs('cart', $cinName, 'public');
        } else {
            $data['scan_cartid'] = $candidat->scan_cartid ?? null;
        }

        // Handle photo file
        if ($request->hasFile('photo')) {
            if ($candidat->photo && Storage::exists($candidat->photo)) {
                Storage::delete($candidat->photo);
            }
            $photoExtension = $request->file('photo')->getClientOriginalExtension();
            $photoName = $baseName . '_photo_' . $timestamp . '.' . $photoExtension;
            $data['photo'] = $request->file('photo')->storeAs('photos', $photoName, 'public');
        } else {
            $data['photo'] = $candidat->photo ?? null;
        }

        // Handle scan_bac file
        if ($request->hasFile('scan_bac')) {
            if ($candidat->scan_bac && Storage::exists($candidat->scan_bac)) {
                Storage::delete($candidat->scan_bac);
            }
            $bacExtension = $request->file('scan_bac')->getClientOriginalExtension();
            $bacName = $baseName . '_bac_' . $timestamp . '.' . $bacExtension;
            $data['scan_bac'] = $request->file('scan_bac')->storeAs('bac', $bacName, 'public');
        } else {
            $data['scan_bac'] = $candidat->scan_bac ?? null;
        }

        $candidat->update($data);

        // Update the inscription if formation_id is provided
        if ($request->has('formation_id')) {
            $inscription = Inscription::where('candidat_id', $candidat->id)->first();
            if ($inscription) {
                $inscription->update([
                    'formation_id' => $request->formation_id,
                    'annee' => now(),
                ]);
            }
        }

        return redirect()->route('candidats.index')->with('success', 'Candidat mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $candidat = Candidat::findOrFail($id);
        
        // Delete related records first if needed
        $candidat->diplomes()->delete();
        $candidat->stages()->delete();
        $candidat->experiences()->delete();
        $candidat->attestations()->delete();
        
        // Delete associated files if they exist
        if ($candidat->CV && Storage::exists($candidat->CV)) Storage::delete($candidat->CV);
        if ($candidat->demande && Storage::exists($candidat->demande)) Storage::delete($candidat->demande);
        if ($candidat->scan_cartid && Storage::exists($candidat->scan_cartid)) Storage::delete($candidat->scan_cartid);
        if ($candidat->photo && Storage::exists($candidat->photo)) Storage::delete($candidat->photo);
        if ($candidat->scan_bac && Storage::exists($candidat->scan_bac)) Storage::delete($candidat->scan_bac);

        // Then delete the candidat
        $candidat->delete();
        
        return redirect()->route('candidats.index')
             ->with('success', 'Candidat supprimé avec succès');
    }
}
