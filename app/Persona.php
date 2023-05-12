<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = [
        'nombre_apellido',
        'cedula',
        'celular_1',
        'celular_2',
        'fecha_nacimiento',
        'email',
        'departamenToString',
        'municipioToString',
        'direccion',
        'observaciones_direccion',
        'barrioVeredaToString',
        'vehiculoToString',
        'puestoVotacionToString',
        'candidatoToString',
        'resposableToString',
        'ayuda',
        'observaciones',
    ];
}
