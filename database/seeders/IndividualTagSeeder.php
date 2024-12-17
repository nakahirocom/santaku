<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IndividualTag;

class IndividualTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndividualTag::create([
            'small_label_id' => 2,
            'individualtag' => "1の段",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        IndividualTag::create([
            'small_label_id' => 2,
            'individualtag' => "2の段",
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
