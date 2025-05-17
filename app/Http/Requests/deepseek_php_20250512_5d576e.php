<?php

namespace App\Http\Requests\Candidat;

use Illuminate\Foundation\Http\FormRequest;

class Bac extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'serie_bac' => 'required|string',
            'annee_bac' => 'required|string',
            'scan_bac' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'serie_bac.required' => 'La série du bac est obligatoire.',
            'annee_bac.required' => 'L\'année du bac est obligatoire.',
            'scan_bac.required' => 'Le scan du bac est obligatoire.',
            'scan_bac.mimes' => 'Le fichier doit être au format PDF, JPG, JPEG ou PNG.',
            'scan_bac.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}