<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Candidat;
use App\Models\Stage;
use App\Models\Attestation;
use App\Models\Experience;
use App\Models\Diplome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CandidatformController extends Controller
{





    public function showForm(Request $request)
    {
        $step = $request->query('step', 1);
        $titres = Formation::all(); // Fetch formations for dropdown
        $data = session('form_data', []); // Retrieve form data from session

        return view('candidat.form', compact('step', 'titres', 'data'));
    }

    public function submitStep(Request $request)
    {
        $step = $request->input('step', 1);
        $formData = session('form_data', []);

        // Validation rules for each step
        $rules = $this->getValidationRules($step);

        // Validate the request
        $validated = $request->validate($rules);

        // Merge validated data into session
        $formData = array_merge($formData, $validated);
        $formData['stages'] = $request->input('stages', []);
        $formData['diplomes'] = $request->input('diplomes', []);
        $formData['attestations'] = $request->input('attestations', []);
        $formData['experiences'] = $request->input('experiences', []);

        // Handle file uploads
        $formData = $this->handleFileUploads($request, $formData, $step);

        // Store updated data in session
        $request->session()->put('form_data', $formData);

        // Move to next step or save if final step
        if ($step < 6) {
            return redirect()->route('candidat.form', ['step' => $step + 1]);
        } else {
            // Save the data to the database
            $this->saveCandidat($formData);

            // Clear session data
            $request->session()->forget('form_data');

            return redirect()->route('candidat.form')->with('success', 'Candidature submitted successfully!');
        }
    }

    public function previousStep(Request $request)
    {
        $step = $request->input('step', 1);
        if ($step > 1) {
            return redirect()->route('candidat.form', ['step' => $step - 1]);
        }
        return redirect()->route('candidat.form');
    }

    private function getValidationRules($step)
    {
        $rules = [];

        if ($step == 1) {
            $rules = [
                'titre_id' => 'required|exists:formations,id',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'nom_ar' => 'required|string',
                'prenom_ar' => 'required|string',
                'CNE' => 'required|string|unique:candidats,CNE',
                'CIN' => 'required|string',
                'date_naissance' => 'required|date',
                'ville_naissance' => 'required|string',
                'ville_naissance_ar'=> 'required|string',
                'province' => 'required|string',
                'pay_naissance' => 'required|string',
                'nationalite' => 'required|string',
                'sex' => 'required|in:Homme,Femme',
                'telephone_mob' => 'required|string',
                'telephone_fix' => 'nullable|string',
                'adresse' => 'required|string',
                'email' => 'required|email|unique:candidats,email',
                'ville' => 'required|string',
                'pays' => 'required|string',
                'CV' => 'required|file|mimes:pdf,doc,docx|max:2048',
                'demande' => 'required|file|mimes:pdf,doc,docx|max:2048',
                'scan_cartid' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ];
        } elseif ($step == 2) {
            $rules = [
                'serie_bac' => 'required|string',
                'annee_bac' => 'required|string',
                'scan_bac' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ];
        } elseif ($step == 3) {
            $rules = [
                'diplomes' => 'required|array|max:3', // At least one diploma, max 3
                'diplomes.*.type_diplome_bac_2' => 'required|string',
                'diplomes.*.annee_diplome_bac_2' => 'required|string',
                'diplomes.*.filier_diplome_bac_2' => 'required|string',
                'diplomes.*.scan_bac_2' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'diplomes.*.etablissement_bac_2' => 'required|string',
            ];
        } elseif ($step == 4) {
            $rules = [
                'stages' => 'nullable|array|max:3', // Optional, max 3
                'stages.*.fonction' => 'string',
                'stages.*.periode' => 'string',
                'stages.*.attestation' => 'file|mimes:pdf,doc,docx|max:2048',
                'stages.*.etablissement' => 'string',
                'stages.*.secteur_activite' => 'string',
                'stages.*.description' => 'string',
            ];
        } elseif ($step == 5) {
            $rules = [
                'attestations' => 'nullable|array|max:3', // Optional, max 3

                'attestations.*.attestation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'attestations.*.type_attestation' => 'nullable|string',
                'attestations.*.description' => 'nullable|string',
            ];
        } elseif ($step == 6) {
            $rules = [
                                'experiences' => 'nullable|array|max:3', // Optional, max 3

                'experiences.*.fonction' => 'nullable|string',
                'experiences.*.periode' => 'nullable|string',
                'experiences.*.attestation' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'experiences.*.etablissement' => 'nullable|string',
                'experiences.*.secteur_activite' => 'nullable|string',
                'experiences.*.description' => 'nullable|string',
            ];
        }

        return $rules;
    }

    private function handleFileUploads(Request $request, array $formData, $step)
    {
        if ($step == 1) {
            if ($request->hasFile('CV')) {
                $formData['CV'] = $request->file('CV')->store('cvs', 'public');
            }
            if ($request->hasFile('demande')) {
                $formData['demande'] = $request->file('demande')->store('cartes', 'public');
            }
            if ($request->hasFile('scan_cartid')) {
                $formData['scan_cartid'] = $request->file('scan_cartid')->store('cartes', 'public');
            }
            if ($request->hasFile('photo')) {
                $formData['photo'] = $request->file('photo')->store('photos', 'public');
            }
        } elseif ($step == 2) {
            if ($request->hasFile('scan_bac')) {
                $formData['scan_bac'] = $request->file('scan_bac')->store('bacs', 'public');
            }
        } elseif ($step == 3) {
            foreach ($request->file('diplomes', []) as $index => $diplome) {
                if (isset($diplome['scan_bac_2'])) {
                    $formData['diplomes'][$index]['scan_bac_2'] = $diplome['scan_bac_2']->store('diplomes', 'public');
                }
            }
        } elseif ($step == 4) {
            foreach ($request->file('stages', []) as $index => $stage) {
                if (isset($stage['attestation'])) {
                    $formData['stages'][$index]['attestation'] = $stage['attestation']->store('stages', 'public');
                }
            }
        } elseif ($step == 5) {
            foreach ($request->file('attestations', []) as $index => $attestation) {
                if (isset($attestation['attestation'])) {
                    $formData['attestations'][$index]['attestation'] = $attestation['attestation']->store('attestations', 'public');
                }
            }
        } elseif ($step == 6) {
            foreach ($request->file('experiences', []) as $index => $experience) {
                if (isset($experience['attestation'])) {
                    $formData['experiences'][$index]['attestation'] = $experience['attestation']->store('experiences', 'public');
                }
            }
        }

        return $formData;
    }

    private function saveCandidat(array $formData)
    {
        $formation = Formation::find($formData['titre_id']);

        $candidat = Candidat::create([
            'formation_id' => $formation->id,
            'type' => $formation->type,
            'titre' => $formation->titre,
            'nom' => $formData['nom'],
            'prenom' => $formData['prenom'],
            'nom_ar' => $formData['nom_ar'],
            'prenom_ar' => $formData['prenom_ar'],
            'CNE' => $formData['CNE'],
            'CIN' => $formData['CIN'],
            'date_naissance' => $formData['date_naissance'],
            'ville_naissance' => $formData['ville_naissance'],
            'ville_naissance_ar' => $formData['ville_naissance_ar'] ?? '',
            'province' => $formData['province'],
            'pay_naissance' => $formData['pay_naissance'],
            'nationalite' => $formData['nationalite'],
            'sex' => $formData['sex'],
            'telephone_mob' => $formData['telephone_mob'],
            'telephone_fix' => $formData['telephone_fix'] ?? null,
            'adresse' => $formData['adresse'],
            'email' => $formData['email'],
            'ville' => $formData['ville'],
            'pays' => $formData['pays'],
            'CV' => $formData['CV'],
            'demande' => $formData['demande'],
            'scan_cartid' => $formData['scan_cartid'],
            'photo' => $formData['photo'],
            'serie_bac' => $formData['serie_bac'],
            'annee_bac' => $formData['annee_bac'],
            'scan_bac' => $formData['scan_bac'],
        ]);
        // Envoi de l'e-mail de confirmation
        try {
            Mail::to($candidat->email)->send(new \App\Mail\CandidatInscriptionConfirmation($candidat));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de l\'e-mail de confirmation : ' . $e->getMessage());
        }

       // Save stages (optional, max 3)
       foreach (array_slice($formData['stages'], 0, 2) as $stage) {
        if (!empty($stage['fonction']) || !empty($stage['periode']) || !empty($stage['attestation'])) {
            Stage::create([
                'candidat_id' => $candidat->id,
                'fonction' => $stage['fonction'] ?? '',
                'periode' => $stage['periode'] ?? '',
                'attestation' => $stage['attestation'] ?? null,
                'etablissement' => $stage['etablissement'] ?? '',
                'description' => $stage['description'] ?? '',
                'secteur_activite' => $stage['secteur_activite'] ?? '',
            ]);
        }
    

        foreach ($formData['diplomes'] as $diplome) {
            if (!empty($diplome['type_diplome_bac_2'])) {
                Diplome::create([
                    'candidat_id' => $candidat->id,
                    'type_diplome_bac_2' => $diplome['type_diplome_bac_2'],
                    'annee_diplome_bac_2' => $diplome['anne45'] . 'annee_diplome_bac_2',
                    'filier_diplome_bac_2' => $diplome['filier_diplome_bac_2'],
                    'scan_bac_2' => $diplome['scan_bac_2'],
                    'etablissement_bac_2' => $diplome['etablissement_bac_2'],
                ]);
            }
        }

        // Save attestations (optional, max 3)
        foreach (array_slice($formData['attestations'], 0, 3) as $attestation) {
            if (!empty($attestation['type_attestation']) || !empty($attestation['description']) || !empty($attestation['attestation'])) {
                Attestation::create([
                    'candidat_id' => $candidat->id,
                    'type_attestation' => $attestation['type_attestation'] ?? '',
                    'description' => $attestation['description'] ?? '',
                    'attestation' => $attestation['attestation'] ?? null,
                ]);
            }
        }
        foreach (array_slice($formData['experiences'], 0, 3) as $experience) {
            if (!empty($experience['fonction']) || !empty($experience['periode']) || !empty($experience['attestation'])) {
                Experience::create([
                    'candidat_id' => $candidat->id,
                    'fonction' => $experience['fonction'] ?? '',
                    'secteur_activite' => $experience['secteur_activite'] ?? '',
                    'periode' => $experience['periode'] ?? '',
                    'etablissement' => $experience['etablissement'] ?? '',
                    'description' => $experience['description'] ?? '',
                    'attestation' => $experience['attestation'] ?? null,
                ]);
            }
        }
    }
}




    

}
