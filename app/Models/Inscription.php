<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class, 'candidat_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}
