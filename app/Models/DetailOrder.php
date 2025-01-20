<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'qty',
        'subtotal'
    ];

    public function Menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
