<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aaro extends Model
{
    use HasFactory;
    protected $table = 'aaro';



    protected $fillable = [
        'AAROID',
        'password',
        'name',
        'ic',
        'email',
        'phone_number',  
     
    ];
}
