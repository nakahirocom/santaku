<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleLabel extends Model
{
    use HasFactory;
    protected $table = 'middle_labels';


    public function largeLabel()
    {
        return $this->belongsTo(LargeLabel::class);
    }

    public function smallLabel()
    {
        return $this->hasMany(SmallLabel::class);
    }
}
