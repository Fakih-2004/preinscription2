<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_diplome_bac2', 'annee_bac2', 'filiere_bac2', 'scan_bac2', 'etablissement_bac2',
        'annee_bac3', 'type_diplome_bac3', 'filiere_bac3', 'scan_bac3', 'candidat_id'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }
}

