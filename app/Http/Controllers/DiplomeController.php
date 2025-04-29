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
        return view('diplomes.index', compact('diplomes'));
    }

    public function create()
    {
        $candidats = Candidat::all();
        return view('diplomes.create', compact('candidats'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Handle scan_bac+2
        if ($request->hasFile('scan_bac+2')) {
            $data['scan_bac+2'] = $request->file('scan_bac+2')->store('scans_bac2', 'public');
        }

        // Handle scan_bac+3
        if ($request->hasFile('scan_bac+3')) {
            $data['scan_bac+3'] = $request->file('scan_bac+3')->store('scans_bac3', 'public');
        }

        Diplome::create($data);
        return redirect()->route('diplomes.index');
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
        return view('diplomes.edit', compact('diplome', 'candidats'));
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
        return redirect()->route('diplomes.index');
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
        return redirect()->route('diplomes.index');
    }
}
