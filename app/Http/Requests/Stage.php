<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;

class Stage extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stages' => 'nullable|array|max:3',
            'stages.*.fonction' => 'nullable|string',
            'stages.*.periode' => 'nullable|string',
            'stages.*.attestation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'stages.*.etablissement' => 'nullable|string',
            'stages.*.secteur_activite' => 'nullable|string',
            'stages.*.description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'stages.max' => 'Vous ne pouvez pas ajouter plus de 3 stages.',
            'stages.*.attestation.mimes' => 'Le fichier doit être au format PDF, DOC ou DOCX.',
            'stages.*.attestation.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}