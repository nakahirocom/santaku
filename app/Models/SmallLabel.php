<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallLabel extends Model
{
    use HasFactory;
    protected $table = 'small_labels';

    public function middleLabel()
    {
        return $this->belongsTo(MiddleLabel::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function labelStorage()
    {
        return $this->hasMany(LabelStorages::class);
    }

    public function rank()
    {
        return $this->hasMany(Rank::class);
    }
    
    public function individualtag()
    {
        return $this->hasMany(IndividualTag::class);
    }


}
