<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id',
        'street_id',
        'delivery',
        'courier',
        'estimation',
        'address',
    ];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
