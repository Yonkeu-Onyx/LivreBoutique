<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable = ["titre", "description", "stock", "prix", "niveauExpertise", "categorie_id"];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
