<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarrioVereda extends Model
{
    protected $table = 'barrio_vereda';
    protected $fillable = ['id','nombre'];
}
