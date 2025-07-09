<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Importation extends Model
{
    protected $fillable = [
        'id',
        'importation_id',
        'fourniseur_name',
        'id_ord',
        'importation_date',
        'montant_algex',
        'montant_definitive',
        'status',
    ];
    public function fourniseur()
    {
        return $this->belongsTo(Fourniseur::class, 'fourniseur_name');
    }
    public function orderimportation()
    {
        return $this->belongsTo(Orderimportation::class, 'id_ord');
    }
    public function predoms()
{
    return $this->hasMany(Predom::class);
}

}
