<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function index()
    {
        $attestations = Attestation::all();
        return view('attestations.index', compact('attestations'));
    }

    public function create()
    {
        return view('attestations.create');
    }

    public function store(Request $request)
    {
        Attestation::create($request->all());
        return redirect()->route('attestations.index');
    }

    public function show($id)
    {
        $attestation = Attestation::findOrFail($id);
        return view('attestations.show', compact('attestation'));
    }

    public function edit($id)
    {
        $attestation = Attestation::findOrFail($id);
        return view('attestations.edit', compact('attestation'));
    }

    public function update(Request $request, $id)
    {
        $attestation = Attestation::findOrFail($id);
        $attestation->update($request->all());
        return redirect()->route('attestations.index');
    }

    public function destroy($id)
    {
        $attestation = Attestation::findOrFail($id);
        $attestation->delete();
        return redirect()->route('attestations.index');
    }
}
