<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommonTag;

class CommonTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommonTag::create([
            'small_label_id' => 1 ,
            'commontag' => "審査中",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        CommonTag::create([
            'small_label_id' => 1 ,
            'commontag' => "2024年",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        CommonTag::create([
            'small_label_id' => 1 ,
            'commontag' => "2023年",
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
