<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::all();
        return view('inscriptions.index', compact('inscriptions'));
    }

    public function create()
    {
        return view('inscriptions.create');
    }

    public function store(Request $request)
    {
        Inscription::create($request->all());
        return redirect()->route('inscriptions.index');
    }

    public function show($id)
    {
        $inscription = Inscription::findOrFail($id);
        return view('inscriptions.show', compact('inscription'));
    }

    public function edit($id)
    {
        $inscription = Inscription::findOrFail($id);
        return view('inscriptions.edit', compact('inscription'));
    }

    public function update(Request $request, $id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->update($request->all());
        return redirect()->route('inscriptions.index');
    }

    public function destroy($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();
        return redirect()->route('inscriptions.index');
    }
}
