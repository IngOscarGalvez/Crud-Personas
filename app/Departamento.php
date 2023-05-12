<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $fillable = ['id','nombre','codigo'];



    public function muncipios()
    {
        return $this->hasMany(Municipio::class,'departamento_id');
    }
}
