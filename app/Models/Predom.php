<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predom extends Model
{
    protected $fillable =[
        'importation_id',
        'predom_id',
        'date_predom',
        'status',
    ];
   public function importation()
{
    return $this->belongsTo(Importation::class);
}
 
}
