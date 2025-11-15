<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
   
    
    protected $fillable = [
        'service_id',
        'date',
        'time',
        'name',
        'phone',
        'email',
        'other_request',
    ];

    public function service()
{
    return $this->belongsTo(Service::class);
}
    
}
