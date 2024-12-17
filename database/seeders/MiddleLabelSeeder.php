<?php

namespace Database\Seeders;

use App\Models\MiddleLabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiddleLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //large_label_idが1のひかり税理士法人の大分類

        MiddleLabel::create([
            'large_label_id' => 1,
            'middle_label' => '算数',

        ]);
        MiddleLabel::create([
            'large_label_id' => 1,
            'middle_label' => '国語',

        ]);
        MiddleLabel::create([
            'large_label_id' => 2,
            'middle_label' => '法人税',
        ]);
        MiddleLabel::create([
            'large_label_id' => 2,
            'middle_label' => '消費税',

        ]);
        MiddleLabel::create([
            'large_label_id' => 3,
            'middle_label' => 'ひかりルール',

        ]);
        MiddleLabel::create([
            'large_label_id' => 3,
            'middle_label' => 'プログラミング',

        ]);
    }
}
