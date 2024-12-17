<?php

namespace Database\Seeders;

use App\Models\AnswerResults;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnswerResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nowWithMilliseconds = Carbon::now()->format('Y-m-d H:i:s.u');
dump($nowWithMilliseconds);

        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 1,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 2,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 3,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 4,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 5,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 6,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 7,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 8,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 9,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 1,
            'user_id' => 1,
            'answered_question_id' => 10,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 11,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 12,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 13,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 14,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 15,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 16,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 17,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 18,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 19,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 2,
            'user_id' => 2,
            'answered_question_id' => 20,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 21,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 22,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 23,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 24,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 25,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 26,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 27,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 28,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 29,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 3,
            'user_id' => 3,
            'answered_question_id' => 30,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 31,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 32,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 33,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 34,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 35,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 36,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 37,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 38,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 39,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 4,
            'user_id' => 4,
            'answered_question_id' => 40,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 41,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 42,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 43,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 44,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 45,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 46,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 47,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 48,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 49,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 5,
            'user_id' => 5,
            'answered_question_id' => 50,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'start_solving_time' => $nowWithMilliseconds,
            'answered_question_id' => 51,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 52,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 53,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 54,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 55,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 56,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 57,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 58,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 59,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 6,
            'user_id' => 6,
            'answered_question_id' => 60,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 61,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 62,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 63,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 64,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 65,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 66,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 67,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 68,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 69,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 7,
            'user_id' => 7,
            'answered_question_id' => 70,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 71,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 72,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 73,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 74,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 75,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 76,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 77,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 78,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 79,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        AnswerResults::create([
            'question_id' => 8,
            'user_id' => 8,
            'answered_question_id' => 80,
            'start_solving_time' => $nowWithMilliseconds,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
