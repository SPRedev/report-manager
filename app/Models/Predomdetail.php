<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predomdetail extends Model
{
    protected $fillable =[
            'predom_id',
            'predomdetail_id',
            'rc_nif',
            'rc_nif_statust',
            'decision',
            'decision_statust',
            'tax',
            'tax_statust',
            'certificate',
            'certificate_statust',
            'facture',
            'facture_statust',
            'engagement',
            'engagement_statust',
    ];
   public function predom()
{
    return $this->belongsTo(Predom::class);
}
 
}