<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    public function index()
    {
        $diplomes = Diplome::all();
        return view('diplomes.index', compact('diplomes'));
    }

    public function create()
    {
        return view('diplomes.create');
    }

    public function store(Request $request)
    {
        Diplome::create($request->all());
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
        return view('diplomes.edit', compact('diplome'));
    }

    public function update(Request $request, $id)
    {
        $diplome = Diplome::findOrFail($id);
        $diplome->update($request->all());
        return redirect()->route('diplomes.index');
    }

    public function destroy($id)
    {
        $diplome = Diplome::findOrFail($id);
        $diplome->delete();
        return redirect()->route('diplomes.index');
    }
}
