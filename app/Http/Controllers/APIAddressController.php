<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class APIAddressController extends Controller
{
    public function getKelurahan($idKecamatan)
    {

        $kecamatan = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $idKecamatan .  '.json');
        return $kecamatan;
    }
}
