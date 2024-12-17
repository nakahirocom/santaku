<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SmallLabel;

class SmallLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmallLabel::create([
            'middle_label_id' => 1,
            'small_label' => "足し算",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 1,
            'small_label' => "引き算",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 2,
            'small_label' => "漢字読み方",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 2,
            'small_label' => "ことわざ",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 3,
            'small_label' => "法人税申告書",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 3,
            'small_label' => "交際費",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 4,
            'small_label' => "課税区分",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 4,
            'small_label' => "消費税法",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 5,
            'small_label' => "請求ルール",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 5,
            'small_label' => "ゼルダの伝説",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 6,
            'small_label' => "Laravel",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        SmallLabel::create([
            'middle_label_id' => 6,
            'small_label' => "Mysql",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
