<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Orderimportation extends Model
{
    protected $fillable = [
        'id_ord',
        'id_fourniseur',
        'date_offre',
        'offre',
        'date_contre_offre',
        'contre_offre',
        'date_confirmation',
        'confirmation',
        'status'
    ];
public function fourniseur(): HasOne
{
    return $this->hasOne(Fourniseur::class, 'id', 'id_fourniseur');
}

}