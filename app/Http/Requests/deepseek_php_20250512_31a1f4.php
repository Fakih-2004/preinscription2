<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;

class Experience extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'experiences' => 'nullable|array|max:3',
            'experiences.*.fonction' => 'nullable|string',
            'experiences.*.periode' => 'nullable|string',
            'experiences.*.attestation' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'experiences.*.etablissement' => 'nullable|string',
            'experiences.*.secteur_activite' => 'nullable|string',
            'experiences.*.description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'experiences.max' => 'Vous ne pouvez pas ajouter plus de 3 expériences.',
            'experiences.*.attestation.mimes' => 'Le fichier doit être au format JPG, JPEG, PNG ou PDF.',
            'experiences.*.attestation.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}