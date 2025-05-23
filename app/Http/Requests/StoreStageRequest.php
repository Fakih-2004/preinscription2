<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'candidat_id' => 'nullable|exists:candidats,id',
            'fonction' => 'nullable|string|max:100',
            'secteur_activite' => 'nullable|string|max:100',
            'periode' => 'nullable|string|max:100',
            'attestation' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'etablissement' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ];
    }
}