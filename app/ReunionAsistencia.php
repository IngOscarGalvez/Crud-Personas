<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReunionAsistencia extends Model
{
    protected $table = 'reuniones_asistencia';
    protected $fillable = ['reunion_id','persona_id'];

    public function persona()
    {
        return $this->hasOne(Persona::class,'id','persona_id');
    }
    public function reunion()
    {
        return $this->hasOne(Reunion::class,'id','reunion_id');
    }
}
