<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'street_id',
        'total',
        'paid',
        'delivery',
        'courier',
        'estimation',
        'cod',
        'receipt',
        'address',
        'status',
    ];
    // public function detailOrders()
    // {
    //     return $this->hasMany(DetailOrder::class);
    // }
    // public function Menus()
    // {
    //     return $this->hasManyThrough(Menu::class, DetailOrder::class, 'menu_id', '', '', 'menu_id');
    // }

    // public function detailOrders()
    // {
    //     return DB::table('detail_orders')
    //         ->join('orders', 'detail_orders.order_id', '=', 'orders.id')
    //         ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
    //         ->select('detail_orders.*', 'orders.total', 'menus.name')
    //         ->get();
    // }
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
