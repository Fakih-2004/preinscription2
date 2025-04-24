<?php 
namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Support\Facades\Storage;

class CandidatController extends Controller
{
    public function index()
    {
        $candidats = Candidat::with('inscriptions.formation')->get();
        return view('candidats.index', compact('candidats'));
    }

    public function create()
    {
        $formations = Formation::all(); // to populate the select
        return view('candidats.create', compact('formations'));
    }

    public function store(Request $request)
    {
        // Handle file uploads and store them in the public storage folder
        $data = $request->except('formation_id'); // Exclude formation_id for now
        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('public/cv');
        }
        if ($request->hasFile('demande')) {
            $data['demande'] = $request->file('demande')->store('public/demande');
        }
        if ($request->hasFile('scan_cartid')) {
            $data['scan_cartid'] = $request->file('scan_cartid')->store('public/cin');
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/photos');
        }
        if ($request->hasFile('scan_bac')) {
            $data['scan_bac'] = $request->file('scan_bac')->store('public/bac');
        }

        $candidat = Candidat::create($data); // Create candidate

        // Create the inscription for the candidate
        Inscription::create([
            'candidat_id' => $candidat->id,
            'formation_id' => $request->formation_id,
            'annee' => now(), 
        ]);

        return redirect()->route('candidats.index');
    }

    public function show($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.show', compact('candidat'));
    }

    public function edit($id)
    {
        $candidat = Candidat::findOrFail($id);
        return view('candidats.edit', compact('candidat'));
    }

    public function update(Request $request, $id)
    {
        $candidat = Candidat::findOrFail($id);

        // Handle file updates
        if ($request->hasFile('cv')) {
            $candidat->cv = $request->file('cv')->store('public/cv');
        }
        if ($request->hasFile('demande')) {
            $candidat->demande = $request->file('demande')->store('public/demande');
        }
        if ($request->hasFile('scan_cartid')) {
            $candidat->scan_cartid = $request->file('scan_cartid')->store('public/cin');
        }
        if ($request->hasFile('photo')) {
            $candidat->photo = $request->file('photo')->store('public/photos');
        }
        if ($request->hasFile('scan_bac')) {
            $candidat->scan_bac = $request->file('scan_bac')->store('public/bac');
        }

        $candidat->update($request->all()); // Update candidate
        return redirect()->route('candidats.index');
    }

    public function destroy($id)
    {
        $candidat = Candidat::findOrFail($id);
        // Delete the files
        Storage::delete([
            $candidat->cv,
            $candidat->demande,
            $candidat->scan_cartid,
            $candidat->photo,
            $candidat->scan_bac
        ]);
        $candidat->delete();
        return redirect()->route('candidats.index');
    }
}
