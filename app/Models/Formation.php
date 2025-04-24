<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'date_debut', 'date_fin', 'administrateur_id'];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}

