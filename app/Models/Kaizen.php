<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaizen extends Model
{
    use HasFactory;

    protected $table = 'kaizens';

    protected $fillable = [
        'user_id',
        'question_id',
        'kaizen',
    ];


    public function user()
    {
        //UserモデルのUserクラス
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        //QuestionモデルのQuestionクラス
        return $this->belongsTo(Question::class);
    }

    
}
