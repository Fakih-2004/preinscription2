<?php

namespace App\Exports;

use App\Models\Candidat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidatsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $formationId;

    public function __construct($formationId)
    {
        $this->formationId = $formationId;
        // $this->diplomes = $diplomes;

    }
    

    public function collection()
    {
        return Candidat::whereHas('inscriptions', function ($query) {
            $query->where('formation_id', $this->formationId);
        })
        ->with([
            'stages',
            'diplomes',
            'attestations',
            'experiences',
            'inscriptions.formation', 
        ])
        ->get();
    }

    public function map($candidat): array
{
    return [
        $candidat->id,
        $candidat->inscriptions->first()->formation->type_formation ?? 'N/A', 
        $candidat->email,
        $candidat->nom,
        $candidat->prenom,
        $candidat->nom_ar,
        $candidat->prenom_ar,
        $candidat->CNE,
        $candidat->CIN,
        $candidat->date_naissance,
        $candidat->ville_naissance,
        $candidat->ville_naissance_ar,
        $candidat->province,
        $candidat->pay_naissance,
        $candidat->nationalite,
        $candidat->sexe,
        $candidat->telephone_mob,
        $candidat->telephone_fix,
        $candidat->adresse,
        $candidat->ville,
        $candidat->pays,
        $candidat->cv ? asset('storage/' . $candidat->cv) : '',
        $candidat->demande ? asset('storage/' . $candidat->demande) : '',
        $candidat->scan_cartid ? asset('storage/' . $candidat->scan_cartid) : '',
        $candidat->photo ? asset('storage/' . $candidat->photo) : '',
        $candidat->serie_bac,
        $candidat->annee_bac,
        $candidat->scan_bac ? asset('storage/' . $candidat->scan_bac) : '',

        // Safe mapping of related tables
        $candidat->stages->count() > 0 ? $candidat->stages->pluck('fonction')->implode('; ') : '',
        'Diplômes' => $candidat->diplomes->map(function ($diplome) {
    return
        "BAC+2: " . $diplome->{'type_diplome_bac+2'} . " (" . $diplome->{'anne_bac+2'} . "), " .
        "Filière: " . $diplome->{'filiere_bac+2'} . ", " .
        "Établissement: " . $diplome->{'etalissement_bac+2'} . "\n" .
        "BAC+3: " . $diplome->{'type_bac+3'} . " (" . $diplome->{'annee_bac+3'} . "), " .
        "Filière: " . $diplome->{'filiere_bac+3'} . ", " .
        "Établissement: " . $diplome->{'etablissement_bac+3'};
        // ❌ No scan_bac+2, scan_bac+3
})->implode("\n\n"),

        $candidat->attestations->count() > 0 ? $candidat->attestations->pluck('type_attestation')->implode('; ') : '',
        $candidat->experiences->count() > 0 ? $candidat->experiences->pluck('fonction')->implode('; ') : '',
    
    
    
    ];
}


    public function headings(): array
    {
        return [
            'ID',
            'Type Formation',
            'Nom',
            'Prénom',
            'Nom AR',
            'Prénom AR',
            'CNE',
            'CIN',
            'Email',
            'Date de naissance',
            'Ville naissance',
            'Ville naissance AR',
            'Province',
            'Pays naissance',
            'Nationalité',
            'Sexe',
            'Téléphone mobile',
            'Téléphone fixe',
            'Adresse',
            'Ville',
            'Pays',
            'CV',
            'Demande',
            'Carte de identité',
            'Photo',
            'Série Bac',
            'Année Bac',
            'Scan Bac',
            'Stages (fonction | période | établissement | secteur)',
            'Diplômes (bac+2) | Diplômes (bac+3)',
            'Attestations (attestation | description | type)',
            'Expériences (fonction | secteur | période | établissement)',
        ];
    }
}
