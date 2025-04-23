<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();
        return view('experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('experiences.create');
    }

    public function store(Request $request)
    {
        Experience::create($request->all());
        return redirect()->route('experiences.index');
    }

    public function show($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experiences.show', compact('experience'));
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->update($request->all());
        return redirect()->route('experiences.index');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return redirect()->route('experiences.index');
    }
}
