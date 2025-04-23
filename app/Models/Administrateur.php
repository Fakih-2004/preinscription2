<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'email', 'password',
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'administrateur_id');
    }
}
