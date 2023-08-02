<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasFactory;
    protected $fillable = [
        'LecturerID',
        'password',
        'name',
        'ic',
        'email',
        'phone_number',  
        'faculty',
        'gender',
    ];
}
