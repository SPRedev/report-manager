<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fourniseur extends Model
{
    protected $fillable = [
        'fourniseur_name', 'phone', 'email', 'region', 'address'
    ];
}

