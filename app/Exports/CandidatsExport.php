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
            'inscriptions.formation', // Include formation details
        ])
        ->get();
    }

    public function map($candidat): array
    {
        return [
            $candidat->id,
            $candidat->inscriptions->first()->formation->type_formation ?? 'N/A', // Formation Type
            $candidat->nom,
            $candidat->prenom,
            $candidat->nom_ar,
            $candidat->prenom_ar,
            $candidat->CNE,
            $candidat->CIN,
            $candidat->email,
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
            $candidat->cv,
            $candidat->demande,
            $candidat->scan_cartid,
            $candidat->photo,
            $candidat->serie_bac,
            $candidat->annee_bac,
            $candidat->scan_bac,
            
            // Stages - Return all stage details
            $candidat->stages->map(function ($stage) {
                return $stage->fonction . ' | ' . $stage->periode . ' | ' . $stage->etablissement . ' | ' . $stage->secteur_activite;
            })->implode(', '),

            // Diplomes - Return all diploma details
            $candidat->diplomes->map(function ($diplome) {
                return $diplome->type_diplome_bac+2 . ' | ' . $diplome->anne_bac+2 . ' | ' . $diplome->filiere_bac+2 . ' | ' . $diplome->etablissement_bac+2;
            })->implode(', ') . ', ' .
            
            $candidat->diplomes->map(function ($diplome) {
                return $diplome->type_bac+3 . ' | ' . $diplome->annee_bac+3 . ' | ' . $diplome->filiere_bac+3 . ' | ' . $diplome->etablissement_bac+3;
            })->implode(', '),

            // Attestations - Return all attestation details
            $candidat->attestations->map(function ($attestation) {
                return $attestation->attestation . ' | ' . $attestation->discription . ' | ' . $attestation->type_attestation;
            })->implode(', '),

            // Experiences - Return all experience details
            $candidat->experiences->map(function ($experience) {
                return $experience->fonction . ' | ' . $experience->secteur_activite . ' | ' . $experience->periode . ' | ' . $experience->etablissement;
            })->implode(', '),
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
