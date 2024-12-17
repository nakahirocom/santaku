<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'region' => "福岡",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Region::create([
            'region' => "東京",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
