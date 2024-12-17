<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kaizen;

class KaizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kaizen::create([
            'question_id' => 1,
            'user_id' => 1,
            'kaizen' => '表現が曖昧 1問目をユーザー1がコメント',
            'status' => 1,
            'developer_comment' => '',
            'developer_comment_update_time' => null,

            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 1,
            'user_id' => 2,
            'kaizen' => '答えが違う 1問目をユーザー2がコメント',
            'status' => 2,
            'developer_comment' => '答えの違いを検証中',
            'developer_comment_update_time' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 5,
            'user_id' => 1,
            'kaizen' => '誤字がある。5問目をユーザー1がコメント',
            'status' => 1,
            'developer_comment' => '',
            'developer_comment_update_time' => null,

            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 5,
            'user_id' => 2,
            'kaizen' => '簡単すぎる。5問目をユーザー2がコメント',

            'status' => 1,
            'developer_comment' => '',
            'developer_comment_update_time' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 35,
            'user_id' => 1,
            'kaizen' => '新聞以外の区分は? 35問目をユーザー1がコメント',

            'status' => 1,
            'developer_comment' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 35,
            'user_id' => 2,
            'kaizen' => '新聞の区分合ってる? 35問目をユーザー2がコメント',

            'status' => 1,
            'developer_comment' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Kaizen::create([
            'question_id' => 60,
            'user_id' => 1,
            'kaizen' => 'HVINGって何? 60問目をユーザー1がコメント',

            'status' => 1,
            'developer_comment' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
