<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieLivre extends Model
{
    public function livres()
    {
        return $this->hasMany(Livre::class);
    }
    public function categorie()
    {
        return $this->hasMany(Categorie::class);
    }
}
