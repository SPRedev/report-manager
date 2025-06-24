<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
        'reference', 'designation', 'marque', 'prix_vente'
    ];

public function orderLines()
{
    return $this->hasMany(OrderLine::class);
}


}
