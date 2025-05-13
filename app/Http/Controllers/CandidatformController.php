<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Candidat;
use App\Models\Stage;
use App\Models\Attestation;
use App\Models\Experience;
use App\Models\Diplome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CandidatInscriptionConfirmation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CandidatformController extends Controller
{
    public function showForm(Request $request)
    {
        $step = $request->query('step', 1);
        $titres = Formation::all();
        $types_formation = Formation::distinct()->pluck('type_formation')->toArray();
        $data = session('form_data', []);

        return view('candidateur.candidat.form', compact('step', 'titres', 'types_formation', 'data'));
    }

    public function submitStep(Request $request)
    {
        $step = $request->input('step', 1);
        $formData = session('form_data', []);

        // Validation rules for each step
        $rules = $this->getValidationRules($step);

        // Validate the request
        $validated = $request->validate($rules);

        // Additional server-side validation for step 1: ensure titre_id matches type_formation
        if ($step == 1) {
            $formation = Formation::findOrFail($validated['titre_id']);
            if ($formation->type_formation !== $validated['type_formation']) {
                return redirect()->route('candidat.form', ['step' => 1])
                    ->withErrors(['titre_id' => 'Le titre de formation sélectionné ne correspond pas au type de formation choisi.'])
                    ->withInput();
            }
        }
// Merge validated data into session
    $formData = array_merge($formData, $validated);

    // Handle arrays and nested data (stages, diplomes, etc.)
    $formData['stages'] = array_merge($formData['stages'] ?? [], $request->input('stages', []));
    $formData['diplomes'] = array_merge($formData['diplomes'] ?? [], $request->input('diplomes', []));
    $formData['attestations'] = array_merge($formData['attestations'] ?? [], $request->input('attestations', []));
    $formData['experiences'] = array_merge($formData['experiences'] ?? [], $request->input('experiences', []));

        // Handle file uploads
        $formData = $this->handleFileUploads($request, $formData, $step);

        // Store updated data in session
        $request->session()->put('form_data', $formData);

        // Move to next step or save if final step
        if ($step < 6) {
            return redirect()->route('candidat.form', ['step' => $step + 1]);
        } else {
            try {
                // Save the data to the database
                $this->saveCandidat($formData);

                // Clear session data
                $request->session()->forget('form_data');

                return redirect()->route('candidat.form')->with('Succès, candidature soumise avec succès. !');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('candidat.form', ['step' => 1])
                    ->withErrors($e->validator)
                    ->withInput();
            }
        }
    }

    private function getValidationRules($step)
    {
        $rules = [];

        if ($step == 1) {
            $rules = [
                'type_formation' => 'required|string|in:' . implode(',', Formation::distinct()->pluck('type_formation')->toArray()),
                'titre_id' => 'required|exists:formations,id',
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'nom_ar' => 'required|string',
                'prenom_ar' => 'required|string',
                'CNE' => 'required|string',
                'CIN' => 'required|string',
                'date_naissance' => 'required|date',
                'ville_naissance' => 'required|string',
                'ville_naissance_ar' => 'required|string',
                'province' => 'required|string',
                'pay_naissance' => 'required|string',
                'nationalite' => 'required|string',
                'sex' => 'required|in:Homme,Femme',
                'telephone_mob' => 'required|string',
                'telephone_fix' => 'nullable|string',
                'adresse' => 'required|string',
                'email' => 'required|email',
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
                // Bac+2 obligatoire
                'type_diplome_bac_2' => 'required|string',
                'annee_diplome_bac_2' => 'required|string',
                'filier_diplome_bac_2' => 'required|string',
                'scan_bac_2' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'etablissement_bac_2' => 'required|string',
                // Bac+3 facultatif
                'type_diplome_bac_3' => 'nullable|string',
                'annee_diplome_bac_3' => 'nullable|string',
                'filier_diplome_bac_3' => 'nullable|string',
                'scan_bac_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'etablissement_bac_3' => 'nullable|string',
            ];
        } elseif ($step == 4) {
            $rules = [
                'stages' => 'nullable|array|max:3',
                'stages.*.fonction' => 'nullable|string',
                'stages.*.periode' => 'nullable|string',
                'stages.*.attestation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'stages.*.etablissement' => 'nullable|string',
                'stages.*.secteur_activite' => 'nullable|string',
                'stages.*.description' => 'nullable|string',
            ];
        } elseif ($step == 5) {
            $rules = [
                'attestations' => 'nullable|array|max:3',
                'attestations.*.attestation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
                'attestations.*.type_attestation' => 'nullable|string',
                'attestations.*.description' => 'nullable|string',
            ];
        } elseif ($step == 6) {
            $rules = [
                'experiences' => 'nullable|array|max:3',
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
        if (isset($formData['diplomes'][0])) {
            if ($request->hasFile('scan_bac_2')) {
                $formData['scan_bac_2'] = $request->file('scan_bac_2')->store('diplomes', 'public');
            }
            if ($request->hasFile('scan_bac_3')) {
                $formData['scan_bac_3'] = $request->file('scan_bac_3')->store('diplomes', 'public');
            }
        }
        }elseif ($step == 4) {
        $stages = $formData['stages'] ?? [];
        foreach ($stages as $index => $stage) {
            if ($request->hasFile("stages.$index.attestation")) {
                $formData['stages'][$index]['attestation'] = $request->file("stages.$index.attestation")->store('stages', 'public');
            }
        }
        } elseif ($step == 5) {
        $attestations = $formData['attestations'] ?? [];
        foreach ($attestations as $index => $attestation) {
            if ($request->hasFile("attestations.$index.attestation")) {
                $formData['attestations'][$index]['attestation'] = $request->file("attestations.$index.attestation")->store('attestations', 'public');
            }
        }
        } elseif ($step == 6) {
        $experiences = $formData['experiences'] ?? [];
        foreach ($experiences as $index => $experience) {
            if ($request->hasFile("experiences.$index.attestation")) {
                $formData['experiences'][$index]['attestation'] = $request->file("experiences.$index.attestation")->store('experiences', 'public');
            }
        }
        }

        return $formData;
    }

   private function saveCandidat(array $formData)
{
    try {
        // Valider les champs de base (sans contrainte d'unicité)
        $validator = Validator::make($formData, [
            'email' => 'required|email',
            'CNE' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $formation = Formation::findOrFail($formData['titre_id']);

        // Créer le candidat avec $formData au lieu de $validatedData
        $candidat = Candidat::create([
            'formation_id' => $formation->id,
            'type_formation' => $formData['type_formation'],
            'titre' => $formation->titre,
            'nom' => $formData['nom'],
            'prenom' => $formData['prenom'],
            'nom_ar' => $formData['nom_ar'],
            'prenom_ar' => $formData['prenom_ar'],
            'CNE' => $formData['CNE'],
            'email' => $formData['email'],
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
            'ville' => $formData['ville'],
            'pays' => $formData['pays'],
            'CV' => $formData['CV'], // Correction pour correspondre à la colonne 'cv'
            'demande' => $formData['demande'],
            'scan_cartid' => $formData['scan_cartid'],
            'photo' => $formData['photo'],
            'serie_bac' => $formData['serie_bac'],
            'annee_bac' => $formData['annee_bac'],
            'scan_bac' => $formData['scan_bac'],
        ]);

        // Journalisation des données complètes du formulaire
        Log::info('Données complètes du formulaire dans saveCandidat:', $formData);

        // Sauvegarde des diplômes
        if (!empty($formData['diplomes']) && is_array($formData['diplomes'])) {
            foreach ($formData['diplomes'] as $diplome) {
                Log::info('Données du diplôme:', $diplome);
                if (!empty($diplome['type_diplome_bac_2'])) {
                    Diplome::create([
                        'candidat_id' => $candidat->id,
                        'type_diplome_bac_2' => $diplome['type_diplome_bac_2'],
                        'annee_diplome_bac_2' => $diplome['annee_diplome_bac_2'],
                        'filier_diplome_bac_2' => $diplome['filier_diplome_bac_2'],
                        'scan_bac_2' => $diplome['scan_bac_2'] ?? null,
                        'etablissement_bac_2' => $diplome['etablissement_bac_2'] ?? '',
                    ]);
                }
                if (!empty($diplome['type_diplome_bac_3'])) {
                    Diplome::create([
                        'candidat_id' => $candidat->id,
                        'type_diplome_bac_3' => $diplome['type_diplome_bac_3'],
                        'annee_diplome_bac_3' => $diplome['annee_diplome_bac_3'],
                        'filier_diplome_bac_3' => $diplome['filier_diplome_bac_3'],
                        'scan_bac_3' => $diplome['scan_bac_3'] ?? null,
                        'etablissement_bac_3' => $diplome['etablissement_bac_3'] ?? '',
                    ]);
                }
            }
        } else {
            Log::warning('Aucune donnée de diplômes trouvée dans formData');
        }

        // Sauvegarde des stages
        if (!empty($formData['stages']) && is_array($formData['stages'])) {
            foreach (array_slice($formData['stages'], 0, 3) as $stage) {
                Log::info('Données du stage:', $stage);
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
        } else {
            Log::warning('Aucune donnée de stages trouvée dans formData');
        }

        // Sauvegarde des attestations
        if (!empty($formData['attestations']) && is_array($formData['attestations'])) {
            foreach (array_slice($formData['attestations'], 0, 3) as $attestation) {
                Log::info('Données de l’attestation:', $attestation);
                Attestation::create([
                    'candidat_id' => $candidat->id,
                    'type_attestation' => $attestation['type_attestation'] ?? '',
                    'description' => $attestation['description'] ?? '',
                    'attestation' => $attestation['attestation'] ?? null,
                ]);
            }
        } else {
            Log::warning('Aucune donnée d’attestations trouvée dans formData');
        }

        // Sauvegarde des expériences
        if (!empty($formData['experiences']) && is_array($formData['experiences'])) {
            foreach (array_slice($formData['experiences'], 0, 3) as $experience) {
                Log::info('Données de l’expérience:', $experience);
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
        } else {
            Log::warning('Aucune donnée d’expériences trouvée dans formData');
        }

        // Envoyer l'email de confirmation avec l'email du candidat
        // Mail::to($formData['email'])->send(new InscriptionConfirmation($formData['nom'] . ' ' . $formData['prenom']));

        // Stocker le message dans la session
        session()->flash('success', 'Candidature soumise avec succès ! Un email de confirmation vous a été envoyé à ' . $formData['email'] . '.');

    } catch (\Exception $e) {
        Log::error('Erreur dans saveCandidat : ' . $e->getMessage());
        throw $e;
    }
}}