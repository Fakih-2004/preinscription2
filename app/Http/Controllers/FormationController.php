<?php
namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User; // Corrected case for User
use Brian2694\Toastr\Facades\Toastr; // Import Toastr facade
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('utilisateur.formations.index', compact('formations'));
    }

    public function create()
    {
        $users = User::all(); // Fixed case: user -> User
        return view('utilisateur.formations.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_formation' => 'required|string',
            'titre' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id'
        ]);
   
        Formation::create($validated);
    
        Toastr::success('Formation ajoutée avec succès', 'Succès');
        return redirect()->route('formations.index');
    }

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.show', compact('formation'));
    }

    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        $users = User::all();
        return view('formations.edit', compact('formation', 'users'));
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        // Validate the request data before updating
        $validated = $request->validate([
            'type_formation' => 'required|string',
            'titre' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'user_id' => 'required|exists:users,id'
        ]);

        $formation->update($validated);

        Toastr::success('Formation mise à jour avec succès', 'Succès');
        return redirect()->route('formations.index');
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        Toastr::success('Formation supprimée avec succès', 'Succès');
        return redirect()->route('formations.index');
    }
}