<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
      protected $fillable = [
        'subject_id', 'name', 'credit', 'day_and_time', 'classroom', 'lecturer_id',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
    public function batch()
    {
    
        return $this->belongsTo(Batch::class);
    }

}
