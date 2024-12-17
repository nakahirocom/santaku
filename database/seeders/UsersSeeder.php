<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ko1',
            'email' => 'ko1@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 1,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 1,
            'continuous_correct_answers' => null,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => '89382092',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'ko2',
            'email' => 'ko2@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 1,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 15,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => '233361375',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko3',
            'email' => 'ko3@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 1,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => '151189117',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko4',
            'email' => 'ko4@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 25,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko5',
            'email' => 'ko5@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 25,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko6',
            'email' => 'ko6@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 25,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko7',
            'email' => 'ko7@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 25,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => 'ko8',
            'email' => 'ko8@aa',
            'email_verified_at' => now(),
            'password' => '$2y$10$8ZafXpVHLtBCNGOZsPc3w.aVGGvzcj7K72z4qgjoePXffT5DgRKFi', // 11111111
            'remember_token' => Str::random(10),
            'region_id' => 2,
            'basic_count' => 20,
            'base_continuous_correct_answers' => 0,
            'user_mode' => 0,
            'continuous_correct_answers' => 25,
            'best_record' => null,
            'best_record_at' => now(),
            'chatwork_room_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
