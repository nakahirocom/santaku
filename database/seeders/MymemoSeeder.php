<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mymemo;

class MymemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mymemo::create([
            'question_id' => 1,
            'user_id' => 1,
            'mymemo' => '1+1はuser1は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 2,
            'user_id' => 1,
            'mymemo' => '2+1はuser1は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 3,
            'user_id' => 1,
            'mymemo' => '3+1はuser1は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 4,
            'user_id' => 1,
            'mymemo' => '4+1はuser1は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 1,
            'user_id' => 2,
            'mymemo' => '1+1はuser2は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 2,
            'user_id' => 2,
            'mymemo' => '2+1はuser2は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 3,
            'user_id' => 2,
            'mymemo' => '3+1はuser2は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Mymemo::create([
            'question_id' => 4,
            'user_id' => 2,
            'mymemo' => '4+1はuser2は再度復習が必要',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
