<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'administrateur_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}

