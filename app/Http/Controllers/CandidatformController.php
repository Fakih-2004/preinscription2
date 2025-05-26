<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Candidat;
use App\Models\Stage;
use App\Models\Attestation;
use App\Models\Experience;
use App\Models\Diplome;
use App\Models\Inscription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\InscriptionConfirmation;
use Illuminate\Support\Facades\Mail;

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

    // Journalisation des données brutes pour débogage
    Log::info('Fichiers dans la requête (Étape ' . $step . '):', $request->allFiles());

    // Règles de validation pour chaque étape
    $rules = $this->getValidationRules($step);

    // Valider la requête
    $validated = $request->validate($rules);

    // Validation côté serveur supplémentaire pour l'étape 1
    if ($step == 1) {
        $formation = Formation::findOrFail($validated['titre_id']);
        if ($formation->type_formation !== $validated['type_formation']) {
            return redirect()->route('candidat.form', ['step' => 1])
                ->withErrors(['titre_id' => 'Le titre de formation sélectionné ne correspond pas au type de formation choisi.'])
                ->withInput();
        }
    }

    // Traiter les téléchargements de fichiers
    $filePaths = $this->handleFileUploads($request, $step);

    // Supprimer les champs de fichiers de $validated
    $validated = array_filter($validated, function ($value) {
        return !($value instanceof \Illuminate\Http\UploadedFile);
    });

    // Fusionner les données validées
    $formData = array_merge($formData, $validated);

    // Gérer les tableaux et préserver les données existantes
    $formData['diplomes'] = $request->has('diplomes') ? array_map(function ($diplome) {
      
        if (isset($diplome['scan_bac_3']) && $diplome['scan_bac_3'] instanceof \Illuminate\Http\UploadedFile) {
            unset($diplome['scan_bac_3']);
        }
        return $diplome;
    }, $request->input('diplomes', [])) : ($formData['diplomes'] ?? []);

    $formData['stages'] = $request->has('stages') ? array_map(function ($stage) {
        if (isset($stage['attestation']) && $stage['attestation'] instanceof \Illuminate\Http\UploadedFile) {
            unset($stage['attestation']);
        }
        return $stage;
    }, $request->input('stages', [])) : ($formData['stages'] ?? []);

    $formData['experiences'] = $request->has('experiences') ? array_map(function ($experience) {
        if (isset($experience['attestation']) && $experience['attestation'] instanceof \Illuminate\Http\UploadedFile) {
            unset($experience['attestation']);
        }
        return $experience;
    }, $request->input('experiences', [])) : ($formData['experiences'] ?? []);

    // Fusionner les chemins de fichiers
    if (!empty($filePaths)) {
        foreach ($filePaths as $key => $value) {
            if (is_array($value)) {
                // Pour les tableaux comme diplomes, stages, etc.
                $formData[$key] = array_map(function ($item, $fileItem) {
                    return array_merge($item, array_filter($fileItem, fn($v) => !is_null($v)));
                }, $formData[$key] ?? [], $value);
            } else {
                $formData[$key] = $value;
            }
        }
    }

    // Journalisation des données après traitement

    // Stocker les données dans la session
    $request->session()->put('form_data', $formData);

    // Passer à l'étape suivante ou sauvegarder
    if ($step < 6) {
        return redirect()->route('candidat.form', ['step' => $step + 1]);
    } else {
        try {
            $this->saveCandidat($formData);
            $request->session()->forget('form_data');
            return redirect()->route('candidat.form')->with('success', 'Succès, candidature soumise avec succès !');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erreur de validation dans la soumission finale : ' . $e->getMessage());
            return redirect()->route('candidat.form', ['step' => 1])
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur dans la soumission finale : ' . $e->getMessage());
            return redirect()->route('candidat.form', ['step' => 1])
                ->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])
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
                'diplomes' => 'required|array',
                'diplomes.0.type_diplome_bac_2' => 'required|string',
                'diplomes.0.annee_diplome_bac_2' => 'required|string',
                'diplomes.0.filiere_diplome_bac_2' => 'required|string',
                'diplomes.0.scan_bac_2' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'diplomes.0.etablissement_bac_2' => 'required|string',
                'diplomes.0.type_diplome_bac_3' => 'nullable|string',
                'diplomes.0.annee_diplome_bac_3' => 'nullable|string',
                'diplomes.0.filiere_diplome_bac_3' => 'nullable|string',
                'diplomes.0.scan_bac_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'diplomes.0.etablissement_bac_3' => 'nullable|string',
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
   private function handleFileUploads(Request $request, $step)
    {
        $filePaths = [];
        $formData = session('form_data', []);
        $candidatName = isset($formData['CNE']) ? strtoupper($formData['CNE']) . 
                        strtolower(str_replace(' ', '', $formData['nom'])) . 
                        strtolower(str_replace(' ', '', $formData['prenom'])) : 'unknown';

        if ($step == 1) {
            $timestamp = now()->format('YmdHis');
            
            if ($request->hasFile('CV')) {
                $file = $request->file('CV');
                $extension = $file->getClientOriginalExtension();
                $filename = $candidatName . '_CV_' . $timestamp . '.' . $extension;
                $filePaths['CV'] = $file->storeAs('CV', $filename, 'public');
            }
            
            if ($request->hasFile('demande')) {
                $file = $request->file('demande');
                $extension = $file->getClientOriginalExtension();
                $filename = $candidatName . '_demande_' . $timestamp . '.' . $extension;
                $filePaths['demande'] = $file->storeAs('demande', $filename, 'public');
            }
            
            if ($request->hasFile('scan_cartid')) {
                $file = $request->file('scan_cartid');
                $extension = $file->getClientOriginalExtension();
                $filename = $candidatName . '_cin_' . $timestamp . '.' . $extension;
                $filePaths['scan_cartid'] = $file->storeAs('cart', $filename, 'public');
            }
            
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = $candidatName . '_photo_' . $timestamp . '.' . $extension;
                $filePaths['photo'] = $file->storeAs('photos', $filename, 'public');
            }
            
        } elseif ($step == 2) {
            if ($request->hasFile('scan_bac')) {
                $file = $request->file('scan_bac');
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->format('YmdHis');
                $filename = $candidatName . '_bac_' . $timestamp . '.' . $extension;
                $filePaths['scan_bac'] = $file->storeAs('bac', $filename, 'public');
            }
            
        } elseif ($step == 3) {
            $filePaths['diplomes'] = $request->input('diplomes', []);
            foreach ($filePaths['diplomes'] as $index => $diplome) {
                if ($request->hasFile("diplomes.$index.scan_bac_2")) {
                    $file = $request->file("diplomes.$index.scan_bac_2");
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = now()->format('YmdHis');
                    $filename = $candidatName . '_bac_2_' . ($index + 1) . '_' . $timestamp . '.' . $extension;
                    $filePaths['diplomes'][$index]['scan_bac_2'] = $file->storeAs('bac_2', $filename, 'public');
                }
                if ($request->hasFile("diplomes.$index.scan_bac_3")) {
                    $file = $request->file("diplomes.$index.scan_bac_3");
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = now()->format('YmdHis');
                    $filename = $candidatName . '_bac_3_' . ($index + 1) . '_' . $timestamp . '.' . $extension;
                    $filePaths['diplomes'][$index]['scan_bac_3'] = $file->storeAs('bac_3', $filename, 'public');
                }
            }
            
        } elseif ($step == 4) {
            $filePaths['stages'] = $request->input('stages', []);
            foreach ($filePaths['stages'] as $index => $stage) {
                if ($request->hasFile("stages.$index.attestation")) {
                    $file = $request->file("stages.$index.attestation");
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = now()->format('YmdHis');
                    $filename = $candidatName . '_stage_' . ($index + 1) . '_' . $timestamp . '.' . $extension;
                    $filePaths['stages'][$index]['attestation'] = $file->storeAs('stages', $filename, 'public');
                }
            }
            
        } elseif ($step == 5) {
            $filePaths['attestations'] = $request->input('attestations', []);
            foreach ($filePaths['attestations'] as $index => $attestation) {
                if ($request->hasFile("attestations.$index.attestation")) {
                    $file = $request->file("attestations.$index.attestation");
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = now()->format('YmdHis');
                    $filename = $candidatName . '_attestation_' . ($index + 1) . '_' . $timestamp . '.' . $extension;
                    $filePaths['attestations'][$index]['attestation'] = $file->storeAs('attestations', $filename, 'public');
                }
            }
            
        } elseif ($step == 6) {
            $filePaths['experiences'] = $request->input('experiences', []);
            foreach ($filePaths['experiences'] as $index => $experience) {
                if ($request->hasFile("experiences.$index.attestation")) {
                    $file = $request->file("experiences.$index.attestation");
                    $extension = $file->getClientOriginalExtension();
                    $timestamp = now()->format('YmdHis');
                    $filename = $candidatName . '_experience_' . ($index + 1) . '_' . $timestamp . '.' . $extension;
                    $filePaths['experiences'][$index]['attestation'] = $file->storeAs('experiences', $filename, 'public');
                }
            }
        }

        return $filePaths;
    }
private function saveCandidat(array $formData)
{
    // Valider les champs de base
    $validator = Validator::make($formData, [
        'email' => 'required|email:rfc,dns',
        'CNE' => 'required|string',
    ]);

    if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
    }

    $formation = Formation::findOrFail($formData['titre_id']);
     // Créer le candidat
            $candidat = Candidat::create([
                'formation_id' => $formation->id,
                'type_formation' => $formData['type_formation'],
                'titre_id' => $formData['titre_id'], // Utiliser titre_id directement
                'titre' => $formation->titre, // Ajouter le titre si la table a une colonne titre
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
                'CV' => $formData['CV'],
                'demande' => $formData['demande'],
                'scan_cartid' => $formData['scan_cartid'],
                'photo' => $formData['photo'],
                'serie_bac' => $formData['serie_bac'],
                'annee_bac' => $formData['annee_bac'],
                'scan_bac' => $formData['scan_bac'],
            ]);

            // Journalisation des données complètes du formulaire
            Log::info('Données complètes du formulaire dans saveCandidat:', $formData);
            // Ajouter une inscription
    Inscription::create([
        'formation_id' => $formData['titre_id'],
        'candidat_id' => $candidat->id,
        'annee' => now()->format('Y-m-d'), // Utiliser l'année en cours au format date
    ]);

            // Sauvegarde des diplômes
 if (!empty($formData['diplomes']) && is_array($formData['diplomes'])) {
    // دمج الدبلومات في سجل واحد
    $mergedDiplome = [];
    foreach ($formData['diplomes'] as $diplome) {
        $mergedDiplome = array_merge($mergedDiplome, array_filter($diplome, fn($value) => !is_null($value) && trim($value) !== ''));
    }

    // التحقق من بيانات Bac+2 الإلزامية
    if (!isset($mergedDiplome['type_diplome_bac_2']) || empty(trim($mergedDiplome['type_diplome_bac_2'])) ||
        !isset($mergedDiplome['annee_diplome_bac_2']) || empty(trim($mergedDiplome['annee_diplome_bac_2'])) ||
        !isset($mergedDiplome['filiere_diplome_bac_2']) || empty(trim($mergedDiplome['filiere_diplome_bac_2'])) ||
        !isset($mergedDiplome['etablissement_bac_2']) || empty(trim($mergedDiplome['etablissement_bac_2'])) ||
        !isset($mergedDiplome['scan_bac_2']) || empty(trim($mergedDiplome['scan_bac_2']))) {
        Log::error('Les informations obligatoires du Bac+2 sont manquantes.', $mergedDiplome);
        throw new \Exception('Les informations obligatoires du Bac+2 sont incomplètes.');
    }

    Log::info('Données du diplôme avant enregistrement', $mergedDiplome);
    try {
        $diplomeEntry = Diplome::create([
            'candidat_id' => $candidat->id,
            'type_diplome_bac_2' => $mergedDiplome['type_diplome_bac_2'],
            'annee_diplome_bac_2' => $mergedDiplome['annee_diplome_bac_2'],
            'filiere_diplome_bac_2' => $mergedDiplome['filiere_diplome_bac_2'],
            'etablissement_bac_2' => $mergedDiplome['etablissement_bac_2'],
            'scan_bac_2' => $mergedDiplome['scan_bac_2'],
            'type_diplome_bac_3' => $mergedDiplome['type_diplome_bac_3'] ?? null,
            'annee_diplome_bac_3' => $mergedDiplome['annee_diplome_bac_3'] ?? null,
            'filiere_diplome_bac_3' => $mergedDiplome['filiere_diplome_bac_3'] ?? null,
            'etablissement_bac_3' => $mergedDiplome['etablissement_bac_3'] ?? null,
            'scan_bac_3' => $mergedDiplome['scan_bac_3'] ?? null,
        ]);
        Log::info('Le diplôme a été enregistré avec succès', $diplomeEntry->toArray());
    } catch (\Exception $e) {
        Log::error("Erreur lors de l'enregistrement du diplôm", [
            'diplome' => $mergedDiplome,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        throw $e;
    }
} else {
    Log::error('Aucune donnée de diplômes trouvée dans formData');
    throw new \Exception('Aucune donnée de diplômes');
}
           // Sauvegarde des stages
if (!empty($formData['stages']) && is_array($formData['stages'])) {
    foreach (array_slice($formData['stages'], 0, 3) as $stage) {
        Log::info('Données du stage:', $stage);
        Stage::create([
            'candidat_id' => $candidat->id,
            'fonction' => $stage['fonction'] ??  null,
            'periode' => $stage['periode'] ??  null,
            'attestation' => $stage['attestation'] ??  null,
            'etablissement' => $stage['etablissement'] ??  null,
            'description' => $stage['description'] ??  null,
            'secteur_activite' => $stage['secteur_activite'] ?? null,
        ]);
    }
} else {
    Log::info('Aucune donnée de stages fournie dans formData'); // Remplacer warning par info
}

// Sauvegarde des attestations
if (!empty($formData['attestations']) && is_array($formData['attestations'])) {
    foreach (array_slice($formData['attestations'], 0, 3) as $attestation) {
        Log::info('Données de l’attestation:', $attestation);
        Attestation::create([
            'candidat_id' => $candidat->id,
            'type_attestation' => $attestation['type_attestation'] ??  null,
            'description' => $attestation['description'] ??  null,
            'attestation' => $attestation['attestation'] ??  null,
        ]);
    }
} else {
    Log::info('Aucune donnée d’attestations fournie dans formData'); // Remplacer warning par info
}

// Sauvegarde des expériences
if (!empty($formData['experiences']) && is_array($formData['experiences'])) {
    foreach (array_slice($formData['experiences'], 0, 3) as $experience) {
        Log::info('Données de l’expérience:', $experience);
        Experience::create([
            'candidat_id' => $candidat->id,
            'fonction' => $experience['fonction'] ??  null,
            'secteur_activite' => $experience['secteur_activite'] ??  null,
            'periode' => $experience['periode'] ??  null,
            'etablissement' => $experience['etablissement'] ??  null,
            'description' => $experience['description'] ?? null,
            'attestation' => $experience['attestation'] ?? null,
        ]);
    }
} else {
    Log::info('Aucune donnée d’expériences fournie dans formData'); // Remplacer warning par info
}
      // Envoyer l'email de confirmation
    try {
        $candidatName = $candidat->nom . ' ' . $candidat->prenom;
        Log::info('Tentative d\'envoi d\'email à:', ['email' => $candidat->email]);
        Mail::to($candidat->email)->send(new InscriptionConfirmation($candidatName));
        Log::info('Email de confirmation envoyé avec succès à:', ['email' => $candidat->email]);
    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'envoi de l\'email de confirmation:', [
            'email' => $candidat->email,
            'erreur' => $e->getMessage(),
        ]);
        return redirect()->route('candidat.form')->with('warning', 'Inscription réussie, mais l\'email de confirmation n\'a pas pu être envoyé. Veuillez contacter l\'administration.');
    }

    return redirect()->route('candidat.form')->with('success', 'Inscription réussie ! Vérifiez votre boîte de réception pour la confirmation.');
}}
