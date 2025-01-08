<?php

namespace Database\Seeders;

use App\Models\Street;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Street::create([
            'district_id' => '1278040',
            'village_id' => '1278040003',
            'street' => 'Jalan Jatiwaringin',
            'cost_id' => 1,
        ]);
    }
}
