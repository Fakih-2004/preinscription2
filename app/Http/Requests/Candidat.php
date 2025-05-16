<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Formation;

class Candidat extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $formationTypes = implode(',', Formation::distinct()->pluck('type_formation')->toArray());

        return [
            'type_formation' => 'required|string|in:'.$formationTypes,
            'titre_id' => 'required|exists:formations,id',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'nom_ar' => 'required|string',
            'prenom_ar' => 'required|string',
            'CNE' => 'required|string|unique:candidats,CNE',
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
            'email' => 'required|email|unique:candidats,email',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'CV' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'demande' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'scan_cartid' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'type_formation.required' => 'Le type de formation est obligatoire.',
            'titre_id.required' => 'Le titre de formation est obligatoire.',
            'titre_id.exists' => 'Le titre de formation sélectionné est invalide.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'nom_ar.required' => 'Le nom en arabe est obligatoire.',
            'prenom_ar.required' => 'Le prénom en arabe est obligatoire.',
            'CNE.required' => 'Le CNE est obligatoire.',
            'CNE.unique' => 'Ce CNE est déjà utilisé.',
            'CIN.required' => 'Le CIN est obligatoire.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'ville_naissance.required' => 'La ville de naissance est obligatoire.',
            'ville_naissance_ar.required' => 'La ville de naissance en arabe est obligatoire.',
            'province.required' => 'La province est obligatoire.',
            'pay_naissance.required' => 'Le pays de naissance est obligatoire.',
            'nationalite.required' => 'La nationalité est obligatoire.',
            'sex.required' => 'Le sexe est obligatoire.',
            'telephone_mob.required' => 'Le téléphone mobile est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'ville.required' => 'La ville est obligatoire.',
            'pays.required' => 'Le pays est obligatoire.',
            'CV.required' => 'Le CV est obligatoire.',
            'demande.required' => 'La lettre de demande est obligatoire.',
            'scan_cartid.required' => 'Le scan de la carte d\'identité est obligatoire.',
            'photo.required' => 'La photo est obligatoire.',
            // Add more custom messages as needed
        ];
    }
}