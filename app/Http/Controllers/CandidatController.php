<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    public function index()
    {
        $candidats = Candidat::all();
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
        $candidat = Candidat::findOrFail($id);
        $candidat->delete();
        return redirect()->route('candidats.index');
    }
}
