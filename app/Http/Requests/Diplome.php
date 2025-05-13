<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;

class Diplome extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'diplomes.0.type_diplome_bac_2' => 'required|string',
            'diplomes.0.annee_diplome_bac_2' => 'required|string',
            'diplomes.0.filier_diplome_bac_2' => 'required|string',
            'diplomes.0.scan_bac_2' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'diplomes.0.etablissement_bac_2' => 'required|string',
            'diplomes.0.type_diplome_bac_3' => 'nullable|string',
            'diplomes.0.annee_diplome_bac_3' => 'nullable|string',
            'diplomes.0.filier_diplome_bac_3' => 'nullable|string',
            'diplomes.0.scan_bac_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'diplomes.0.etablissement_bac_3' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'diplomes.0.type_diplome_bac_2.required' => 'Le type de diplôme Bac+2 est obligatoire.',
            'diplomes.0.annee_diplome_bac_2.required' => 'L\'année du diplôme Bac+2 est obligatoire.',
            'diplomes.0.filier_diplome_bac_2.required' => 'La filière du diplôme Bac+2 est obligatoire.',
            'diplomes.0.scan_bac_2.required' => 'Le scan du diplôme Bac+2 est obligatoire.',
            'diplomes.0.etablissement_bac_2.required' => 'L\'établissement du diplôme Bac+2 est obligatoire.',
            'diplomes.0.scan_bac_2.mimes' => 'Le fichier doit être au format JPG, JPEG, PNG ou PDF.',
            'diplomes.0.scan_bac_2.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
            'diplomes.0.scan_bac_3.mimes' => 'Le fichier doit être au format JPG, JPEG, PNG ou PDF.',
            'diplomes.0.scan_bac_3.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}