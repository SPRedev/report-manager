<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Importation extends Model
{
      protected $fillable = [
        'id',
        'importation_id',
        'fourniseur_name',
        'importation_date',
        'montant_algex',
        'montant_definitive',
        'status',
    ];
    public function fourniseur()
    {
        return $this->belongsTo(Fourniseur::class, 'fourniseur_name');
    }
}
