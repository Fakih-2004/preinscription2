<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        public function index()
    {
        $formations=Formation::all();
        return view('formations.index',compact('formations'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Formation::create($request->all());
        return redirect()->route('formations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        return view('formations.edit' , compact('formations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        
        $formation=update($request->all());
        return redirect()->route('formations.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        
        $formation->delete();  
        return redirect()->route("formations.index")->with("destroy", "La formation a été supprimée avec succès.");
    }
}
