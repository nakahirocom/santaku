<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelStorages extends Model
{
    use HasFactory;
    protected $table = 'label_storages';

    public function smallLabel()
    {
        return $this->belongsTo(SmallLabel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
