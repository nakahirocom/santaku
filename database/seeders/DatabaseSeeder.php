<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RegionSeeder::class,
            LargeLabelSeeder::class,
            MiddleLabelSeeder::class,
            SmallLabelSeeder::class,
            UsersSeeder::class,
            CommonTagSeeder::class,
            individualTagSeeder::class,
            LabelStorageSeeder::class,
            QuestionSeeder::class,
            AnswerResultsSeeder::class,
            KaizenSeeder::class,
            MymemoSeeder::class

        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
