<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['function', 'secteur_activite', 'periode', 'attestation', 'candidate_id', 'etablissement', 'discretion'];


    public function candidate()
    {
        return $this->belongsTo(Candidat::class, 'candidate_id');
    }
}
