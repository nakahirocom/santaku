<?php

namespace App\Services;

use App\Models\Question;
use Carbon\Carbon;

class SantakuService
{
    public function countYesterdayTweets(): int
    {
        return Question::whereDate(
            'created_at',
            '>=',
            Carbon::yesterday()->toDateTimeString()
        )
            ->whereDate(
                'created_at',
                '<',
                Carbon::today()->toDateTimeString()
            )
            ->count();
    }

    //自分の作成問題かをチェックするメソッド
    public function checkOwnMondai(int $userId, int $questionId): bool
    {
        $question = Question::where('id', $questionId)->first();
        if (!$question) {
            return false;
        }

        return $question->user_id === $userId;
    }
}
