<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['function', 'periode', 'attestation', 'candidate_id', 'etablissement', 'secteur_activite', 'discretion'];

    public function candidate()
    {
        return $this->belongsTo(Candidat::class, 'candidate_id');
    }
}
