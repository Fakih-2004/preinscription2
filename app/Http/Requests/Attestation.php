<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;

class Attestation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'attestations' => 'nullable|array|max:3',
            'attestations.*.attestation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'attestations.*.type_attestation' => 'nullable|string',
            'attestations.*.description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'attestations.max' => 'Vous ne pouvez pas ajouter plus de 3 attestations.',
            'attestations.*.attestation.mimes' => 'Le fichier doit être au format PDF, DOC ou DOCX.',
            'attestations.*.attestation.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}