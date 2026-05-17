<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ["contenu", "statut", "livre_id", "client_id"];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }
}
