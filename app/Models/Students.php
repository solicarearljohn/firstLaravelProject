<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{   
    //students table
    protected $table = 'students';
    protected $fillable = ['name', 'age', 'gender'];
}