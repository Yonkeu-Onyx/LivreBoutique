<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = ['livre_id', 'client_id', 'date', 'quantite'];

    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
