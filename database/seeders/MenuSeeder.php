<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([

            'title' => 'Nasi Ayam Bakar',
            'description' => 'nasi dengan ayam bakar',
            'pric' => 21000,
            'old_price' => 21000,
            'POPULAR' => 0,
            'image' => 'image',
            'categorie_id' => 1,
        ]);
    }
}
