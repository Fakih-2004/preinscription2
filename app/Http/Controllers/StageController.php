<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::all();
        return view('stages.index', compact('stages'));
    }

    public function create()
    {
        return view('stages.create');
    }

    public function store(Request $request)
    {
        Stage::create($request->all());
        return redirect()->route('stages.index');
    }

    public function show($id)
    {
        $stage = Stage::findOrFail($id);
        return view('stages.show', compact('stage'));
    }

    public function edit($id)
    {
        $stage = Stage::findOrFail($id);
        return view('stages.edit', compact('stage'));
    }

    public function update(Request $request, $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->update($request->all());
        return redirect()->route('stages.index');
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return redirect()->route('stages.index');
    }
}
