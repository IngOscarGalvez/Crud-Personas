<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $table = 'dependencia';
    protected $fillable = ['id','nombre','estado'];
}
