<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//this is my table students
class Students extends Model
{
    protected $table = 'students';
    protected $fillable = ['name', 'age', 'gender'];
}