<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studenttimetable extends Model
{
    protected $table = 'studenttimetable';

    use HasFactory;
    protected $fillable = [
      'subject_id', 'batch_id',
  ];

  public function subject()
  {
      return $this->belongsTo(Subject::class);
  }
  public function batch()
  {
      return $this->belongsTo(Batch::class);
  }
  
  
}
