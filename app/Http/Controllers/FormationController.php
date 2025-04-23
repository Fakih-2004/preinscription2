<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
=======
    /**
     * Display a listing of the resource.
     */
    
        public function index()
    {
        $formations=Formation::all();
        return view('formations.index',compact('formations'));
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }
    

    public function create()
    {
<<<<<<< HEAD
        return view('formations.create');
=======
        return view('formation.create');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function store(Request $request)
    {
        Formation::create($request->all());
        return redirect()->route('formations.index');
    }

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.show', compact('formation'));
    }

    public function edit($id)
    {
<<<<<<< HEAD
        $formation = Formation::findOrFail($id);
        return view('formations.edit', compact('formation'));
=======
        return view('formations.edit' , compact('formations'));
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $formation = Formation::findOrFail($id);
        $formation->update($request->all());
        return redirect()->route('formations.index');
=======
        
        $formation=update($request->all());
        return redirect()->route('formations.index');
        
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('formations.index');
=======
        
        $formation->delete();  
        return redirect()->route("formations.index")->with("destroy", "La formation a été supprimée avec succès.");
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }
}
