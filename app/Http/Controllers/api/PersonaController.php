<?php

namespace App\Http\Controllers\api;

use App\Persona;
use Carbon\Carbon;
use App\ReunionAsistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{

    public function store(Request $request)
    {
        // validate
        $persona = Persona::query()->where('cedula','=',$request->cedula)->first();
        if($persona){
            return response()->json(array(
                'message'   => "Ya esta creada la Cedula!"
            ),403);
        }

        $persona=new Persona();
        $persona->nombre_apellido = $request->nombre_apellido;
        $persona->cedula = $request->cedula;
        $persona->celular_1 = $request->celular_1;
        $persona->celular_2 = $request->celular_2;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->email = $request->email;
        $persona->departamenToString = $request->departamenToString;
        $persona->municipioToString = $request->municipioToString;
        $persona->direccion = $request->direccion;
        $persona->observaciones_direccion = $request->observaciones_direccion;
        $persona->barrioVeredaToString = $request->barrioVeredaToString;
        $persona->vehiculoToString = $request->vehiculoToString;
        $persona->puestoVotacionToString = $request->puestoVotacionToString;
        $persona->candidatoToString = $request->candidatoToString;
        $persona->resposableToString = $request->resposableToString;
        $persona->ayuda = $request->ayuda;
        $persona->observaciones = $request->observaciones;
        $persona->profesion = $request->profesion;
        $persona->mesa_votacion = $request->mesa_votacion;
        $persona->lugar_trabajo = $request->lugar_trabajo;
        $persona->lider = $request->lider;
        $persona->save();

        return response()->json(array(
            'message'   => "Se creó la Persona!"
        ),201);
    }

    public function edit($id)
    {
        $persona = Persona::query()->where('id','=',$id)->first();

        return response()->json(array(
            'nombre_apellido' => $persona->nombre_apellido,
            'cedula' => $persona->cedula,
            'celular_1' => $persona->celular_1,
            'celular_2' => $persona->celular_2,
            'fecha_nacimiento' => $persona->fecha_nacimiento,
            'email' => $persona->email,
            'departamentoTags' => $this->formatSelect2($persona->departamenToString),
            'departamenToString' => $persona->departamenToString,
            'municipioTags' => $this->formatSelect2($persona->municipioToString),
            'municipioToString' => $persona->municipioToString,
            'direccion' => $persona->direccion,
            'observaciones_direccion' => $persona->observaciones_direccion,
            'barrioVeredaTags' => $this->formatSelect2($persona->barrioVeredaToString),
            'barrioVeredaToString' => $persona->barrioVeredaToString,
            'vehiculoTags' => $this->formatSelect2($persona->vehiculoToString),
            'vehiculoToString' => $persona->vehiculoToString,
            'puestoVotacionTags' => $this->formatSelect2($persona->puestoVotacionToString),
            'puestoVotacionToString' => $persona->puestoVotacionToString,
            'candidatoTags' => $this->formatSelect2($persona->candidatoToString),
            'candidatoToString' => $persona->candidatoToString,
            'resposableTags' => $this->formatSelect2($persona->resposableToString),
            'resposableToString' => $persona->resposableToString,
            'observaciones' => $persona->observaciones,
            'ayuda' => $persona->ayuda,
            'profesion' => $persona->profesion,
            'mesa_votacion' => $persona->mesa_votacion,
            'lugar_trabajo' => $persona->lugar_trabajo,
            'lider' => $persona->lider,
            'foto_perfil' => $persona->foto_perfil,
            'asistencias' => $this->asistencias($id)
        ),200);


    }

    public function asistencias($id)
    {
        $asistencias = ReunionAsistencia::where('persona_id',$id)->with('reunion')->get();
        $array = [];
        foreach ($asistencias as $asistencia) {
            array_push($array,$asistencia->reunion->nombre);
        }
        return $array;
    }

    public function update(Request $request,$id)
    {
        // validate
        $persona = Persona::query()->where('id','=',$request->id)->first();

        $persona->nombre_apellido = $request->nombre_apellido;
        $persona->cedula = $request->cedula;
        $persona->celular_1 = $request->celular_1;
        $persona->celular_2 = $request->celular_2;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->email = $request->email;
        $persona->departamenToString = $request->departamenToString;
        $persona->municipioToString = $request->municipioToString;
        $persona->direccion = $request->direccion;
        $persona->observaciones_direccion = $request->observaciones_direccion;
        $persona->barrioVeredaToString = $request->barrioVeredaToString;
        $persona->vehiculoToString = $request->vehiculoToString;
        $persona->puestoVotacionToString = $request->puestoVotacionToString;
        $persona->candidatoToString = $request->candidatoToString;
        $persona->resposableToString = $request->resposableToString;
        $persona->ayuda = $request->ayuda;
        $persona->observaciones = $request->observaciones;
        $persona->profesion = $request->profesion;
        $persona->mesa_votacion = $request->mesa_votacion;
        $persona->lugar_trabajo = $request->lugar_trabajo;
        $persona->lider = $request->lider;
        $persona->save();

        return response()->json(array(
            'message'   => "Se Actualizó la Persona!"
        ),200);
    }

    public function formatSelect2($string)
    {
        $array = explode(',',$string);
        $array_new = [];
        if(count($array)> 0 && $string != null){
            foreach ($array as $key => $value) {
                array_push($array_new,[
                    'text' => $value,
                    'tiClasses' => ['ti-valid']
                ]);
            }
        }
        return $array_new;
    }

    public function index()
    {
        $dependencias=Persona::query()->orderBy('nombre_apellido','ASC')->get();
        $array=[];
        $i=1;
        foreach ($dependencias as $dependencia){
            $asistencias = implode('|',$this->asistencias($dependencia->id));
            array_push($array,[
                'cedula'=>$dependencia->cedula,
                'number'=>$i,
                'nombre_apellido'=>$dependencia->nombre_apellido,
                'id'=>$dependencia->id,
                'departamenToString'=>$dependencia->departamenToString,
                'municipioToString'=>$dependencia->municipioToString,
                'puestoVotacionToString'=>$dependencia->puestoVotacionToString,
                'resposableToString'=>$dependencia->resposableToString,
                'asistencias' => $asistencias,
                'estado'=>$dependencia->estado,
            ]);

            $i++;
        }
        return $array;
    }

    public function estado(Request $request){
        $id=$request->id;

        $dependencia=Persona::find($id);
        $estado=$dependencia->estado;
        if ($estado){
            $dependencia->estado=0;
        }else{
            $dependencia->estado=1;
        }

        $dependencia->save();

    }

    public function subirFoto(Request $request,$id)
    {
        $imagen = $request->file('foto_perfil');
        $ruta = Storage::putFile('public/fotos_perfil', $imagen);

        // Guardar la ruta de la imagen en la base de datos del usuario
        $persona = Persona::query()->where('id','=',$id)->first();
        $persona->foto_perfil = Storage::url($ruta);
        $persona->save();

        return response()->json(['mensaje' => 'Foto de perfil subida correctamente']);
    }


    public function personasCumpleannos()
    {
        $now = Carbon::now();
        $month = $now->month;
        $day = $now->day;

        $personas = DB::table('personas')
            ->whereMonth('fecha_nacimiento', '=', $month)
            ->whereDay('fecha_nacimiento', '=', $day)
            ->get();

        return $personas;
    }


}
