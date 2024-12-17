<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LargeLabel extends Model
{
    use HasFactory;
    protected $table = 'large_labels';

    public function middleLabel()
    {
        return $this->hasMany(MiddleLabel::class);
    }
}
