<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestoVotacion extends Model
{
    protected $table = 'puesto_votacion';
    protected $fillable = ['id','nombre'];
}
