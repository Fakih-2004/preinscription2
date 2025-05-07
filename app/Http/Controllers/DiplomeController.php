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
        $validated = $request->all();
        $candidat = Candidat::findOrFail($request->candidat_id);



        
        if ($request->hasFile('scan_bac+2')) {
            $count = Diplome::where('candidat_id', $candidat->id)->count() + 1;
    
            $file = $request->file('scan_bac+2');
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
    
            $filename = strtoupper($candidat->CNE)
                .'_'. strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_bac+2_' . $count . '_' . $timestamp . '.' . $extension;
    
            $path = $file->storeAs('bac_2', $filename, 'public');
            $validated['scan_bac+2'] = $path;
        }
        if ($request->hasFile('scan_bac+3')) {
            $count = Diplome::where('candidat_id', $candidat->id)->count() + 1;
    
            $file = $request->file('scan_bac+3');
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
    
            $filename = strtoupper($candidat->CNE)
                .'_'. strtolower(str_replace(' ', '', $candidat->nom))
                . strtolower(str_replace(' ', '', $candidat->prenom))
                . '_bac+3_' . $count . '_' . $timestamp . '.' . $extension;
    
            $path = $file->storeAs('bac+3', $filename, 'public');
            $validated['scan_bac+3'] = $path;
        }
    
        Diplome::create($validated);

        
        return redirect()->route('utilisateur.diplomes.index');
    }

    public function show($id)
    {
        $diplome = Diplome::findOrFail($id);
        return view('utilisateur.diplomes.show', compact('diplome'));
    }

    public function edit($id)
    {
        $diplome = Diplome::findOrFail($id);
        $candidats = Candidat::all();
        return view('utilisateur.diplomes.edit', compact('diplome', 'candidats'));
    }

    public function update(Request $request, $id)
    {
        $diplome = Diplome::findOrFail($id);
        $data = $request->all();

        // Handle scan_bac+2
        if ($request->hasFile('scan_bac+2')) {
            if ($diplome->scan_bac+2 && Storage::disk('public')->exists($diplome->scan_bac+2)) {
                Storage::disk('public')->delete($diplome->scan_bac+2);
            }
            $data['scan_bac+2'] = $request->file('scan_bac+2')->store('bac2', 'public');
        }

        // Handle scan_bac+3
        if ($request->hasFile('scan_bac+3')) {
            if ($diplome->scan_bac+3 && Storage::disk('public')->exists($diplome->scan_bac+3)) {
                Storage::disk('public')->delete($diplome->scan_bac+3);
            }
            $data['scan_bac+3'] = $request->file('scan_bac+3')->store('bac3', 'public');
        }

        $diplome->update($data);
        return redirect()->route('utilisateur.diplomes.create');
    }

    public function destroy($id)
    {
        $diplome = Diplome::findOrFail($id);

        // Delete scan files
        if ($diplome->scan_bac+2 && Storage::disk('public')->exists($diplome->scan_bac+2)) {
            Storage::disk('public')->delete($diplome->scan_bac+2);
        }
        if ($diplome->scan_bac+3 && Storage::disk('public')->exists($diplome->scan_bac+3)) {
            Storage::disk('public')->delete($diplome->scan_bac+3);
        }

        $diplome->delete();
        return redirect()->route('utilisateur.diplomes.index');
    }
}
