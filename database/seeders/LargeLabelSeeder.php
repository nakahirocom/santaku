<?php

namespace Database\Seeders;

use App\Models\LargeLabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LargeLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LargeLabel::create([
            'large_label' => '小学校習う',
        ]);
        LargeLabel::create([
            'large_label' => '税理士業務',
        ]);
        LargeLabel::create([
            'large_label' => 'その他',
        ]);
    }
}
