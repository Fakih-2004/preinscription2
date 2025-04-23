<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = ['attestation', 'candidate_id', 'discretion', 'type_attestation'];

    public function candidate()
    {
        return $this->belongsTo(Candidat::class, 'candidate_id');
    }
}

