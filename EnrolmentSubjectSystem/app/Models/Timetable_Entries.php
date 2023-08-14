<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timetable_entries extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'subjects_data',
    ];

    protected $casts = [
        'subjects_data' => 'array',
    ];
    
}
