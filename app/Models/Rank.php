<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $table = 'ranks';

    protected $fillable = [
        'small_label_id',
        'user_id',
        'small_label',
        'rank',
        'name',
        'accuracy',
        'correct',
        'incorrect',
        'total',
        'average_time',
        'time'
    ];

    public function smallLabel()
    {
        return $this->belongsTo(SmallLabel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
