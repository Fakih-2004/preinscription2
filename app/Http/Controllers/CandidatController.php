<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $candidats = Candidat::all();
=======
        $candidats = Diplome::all();
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
        return view('candidats.index', compact('candidats'));
    }

    public function create()
    {
        return view('candidats.create');
    }

    public function store(Request $request)
    {
        Candidat::create($request->all());
        return redirect()->route('candidats.index');
    }

    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.show', compact('candidat'));
    }

    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.edit', compact('candidat'));
    }

    public function update(Request $request, $id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->update($request->all());
        return redirect()->route('candidats.index');
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $candidat = Candidat::findOrFail($id);
        $candidat->delete();
        return redirect()->route('candidats.index');
=======
        $candidat->delete();
        return redirect()->route('candidats.index')->with('destroy', 'candidat a été supprimée avec succès.');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }
}
