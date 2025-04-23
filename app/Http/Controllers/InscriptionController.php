<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $inscriptions = Inscription::all();
        return view('inscriptions.index', compact('inscriptions'));
=======
        $inscriptions=Inscription::all();
        return view('inscriptions.index',compact('inscriptions'));
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function create()
    {
<<<<<<< HEAD
        return view('inscriptions.create');
=======
        return view('inscription.create');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
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
<<<<<<< HEAD
        $inscription = Inscription::findOrFail($id);
        return view('inscriptions.edit', compact('inscription'));
=======
        return view('inscriptions.edit' , compact('inscriptions'));
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $inscription = Inscription::findOrFail($id);
        $inscription->update($request->all());
=======
        
        $inscription=update($request->all());
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
        return redirect()->route('inscriptions.index');
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();
        return redirect()->route('inscriptions.index');
=======
        $inscription->delete();
        return redirect()->route('inscriptions.index')->with('destroy', 'L\'inscription a été supprimée avec succès.');
>>>>>>> ddc0b60c9c6d5705d48c7aadbc944a689c6f0e81
    }
}
