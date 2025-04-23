<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
=======
        
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
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
<<<<<<< HEAD
        return redirect()->route('experiences.index');
=======
        return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée avec succès.');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function show($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experiences.show', compact('experience'));
    }

    public function edit($id)
    {
<<<<<<< HEAD
        $experience = Experience::findOrFail($id);
=======
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
        return view('experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $experience = Experience::findOrFail($id);
        $experience->update($request->all());
        return redirect()->route('experiences.index');
=======
        $experience->update($request->all());
        return redirect()->route('experiences.index')->with('update', 'Expérience mise à jour avec succès.');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return redirect()->route('experiences.index');
=======
        $experience->delete();
        return redirect()->route('experiences.index')->with('destroy', 'Expérience supprimée avec succès.');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }
    
}
