<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerResults extends Model
{
    use HasFactory;

    protected $table = 'answer_results';
    protected $dateFormat = 'Y-m-d H:i:s.u';
    protected $dates = [
        'start_solving_time',
        'created_at',
        'updated_at',
    ];
    //    protected $fillable = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
