<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      protected $fillable = [
        'client_id',
        'commercial_id',
        'order_date',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commercial()
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }
public function orderLines()
{
    return $this->hasMany(OrderLine::class);
}


}
