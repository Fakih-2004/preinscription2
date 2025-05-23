<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow only authenticated users to make this request
        return auth()->check();
    }

    public function rules(): array
    {
        $currentYear = now()->year; // 2025 as of May 17, 2025

        // Base rules for all requests
        $rules = [
            'type_formation' => ['required', 'string', 'in:licence,master'],
            'titre' => ['required', 'string', 'max:100'],
            'date_debut' => ['required', 'date', "before_or_equal:$currentYear-12-31"],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut', "before_or_equal:$currentYear-12-31"],
            'administrateur_id' => ['required', 'exists:administrateurs,id'],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type_formation.required' => 'Le type de formation est obligatoire.',
            'type_formation.in' => 'Le type de formation doit être soit "licence" soit "master".',
            'titre.required' => 'Le titre est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 100 caractères.',
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_debut.before_or_equal' => 'La date de début ne peut pas dépasser le 31 décembre de l\'année en cours.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'date_fin.before_or_equal' => 'La date de fin ne peut pas dépasser le 31 décembre de l\'année en cours.',
            'administrateur_id.exists' => 'L\'administrateur sélectionné est invalide.',
        ];
    }
}