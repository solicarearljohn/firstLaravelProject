<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{   //Table Name
    protected $table = 'students';
    protected $fillable = ['name', 'age', 'gender'];
}