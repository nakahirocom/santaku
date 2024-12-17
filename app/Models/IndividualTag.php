<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualTag extends Model
{
    use HasFactory;
    protected $table = 'individual_tags';


    public function smallLabel()
    {
        return $this->belongsTo(SmallLabel::class);
    }

    public function labelStorage()
    {
        return $this->hasMany(LabelStorages::class);
    }

}
