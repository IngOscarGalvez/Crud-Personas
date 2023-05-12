<?php

namespace App\Http\Controllers\api;

use App\Persona;
use App\Reunion;
use App\ReunionAsistencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReunionAsistenciaController extends Controller
{
    public function getReunion($id)
    {
        $reunion = Reunion::find($id);
        return [
            'id' => $reunion->id,
            'nombre' => $reunion->nombre
        ];
    }

    public function getPersona($identificacion)
    {
        $persona = Persona::query()->where('cedula','=',$identificacion)->first();
        if($persona){
            return [
                'nombre_apellido' => $persona->nombre_apellido,
                'id' => $persona->id,
            ];
        }else{
            return [
                'nombre_apellido' => null,
                'id' => null,
            ];
        }

    }

    public function asistenciaPersona(Request $request)
    {
        $persona_id = $request->persona_id;
        $reunion_id = $request->reunion_id;

        $persona = Persona::find($persona_id);
        if(!$persona){
            return response()->json(array(
                'message'   => "No se encontro la Persona!"
            ),404);
        }
        $reunion = Reunion::find($reunion_id);
        if(!$reunion){
            return response()->json(array(
                'message'   => "No se encontro la Reunion Asistencia!"
            ),404);
        }

        $asistencia = ReunionAsistencia::query()->where([['reunion_id',$reunion_id],['persona_id',$persona_id]])->first();
        if($asistencia){
            return response()->json(array(
                'message'   => "Ya existe en la Asistencia!"
            ),403);
        }
        $reunion_asistencia = new ReunionAsistencia();
        $reunion_asistencia->reunion_id = $reunion_id;
        $reunion_asistencia->persona_id = $persona_id;
        $reunion_asistencia->save();
        return response()->json(array(
            'message'   => "Se Creo la Asistencia!"
        ),200);

    }

    public function index($id)
    {
        $array = [];
        $asitencias = ReunionAsistencia::where('reunion_id',$id)->with('persona')->get();
        $i=1;
        foreach ($asitencias as $asistencia) {
            array_push($array,[
                'number'=>$i,
                'id' => $asistencia->id,
                'cedula' => $asistencia->persona->cedula,
                'nombre_apellido' => $asistencia->persona->nombre_apellido
            ]);
            $i++;
        }

        return $array;
    }

    public function destroy($id)
    {
       return ReunionAsistencia::destroy($id);
    }
}
