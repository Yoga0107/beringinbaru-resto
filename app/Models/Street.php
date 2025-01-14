<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

class Street extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'district_id',
        'village_id',
        'street',
        'cost_id',
    ];

    protected $appends = ['district', 'village'];

    // kecamatan
    public function getDistrictAttribute()
    {
        $dictrict = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/district/' . $this->district_id .  '.json');
        return $dictrict['name'];
    }

    // kelurahan 
    public function getVillageAttribute()
    {
        $village = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/village/' . $this->village_id .  '.json');
        return $village['name'];
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class, 'id');
    }
}
