<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'nom_ar', 'prenom_ar', 'CNE', 'CIN', 'date_naissance', 
        'ville_naissance', 'ville_naissance_ar', 'province', 'pay_naissance', 
        'nationalite', 'sexe', 'telephone_mob', 'telephone_fix', 'adresse', 
        'email', 'ville', 'pays', 'cv', 'demand', 'scan_cartid', 'photo', 
        'serie_bac', 'annee_bac', 'scan_bac',
    ];

    public function diplomes()
    {
        return $this->hasMany(Diplome::class, 'candidat_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function attestations()
    {
        return $this->hasMany(Attestation::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
