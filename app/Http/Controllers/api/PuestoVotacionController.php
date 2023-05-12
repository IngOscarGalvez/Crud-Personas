<?php

namespace App\Http\Controllers\api;

use App\PuestoVotacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PuestoVotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PuestoVotacion[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $dependencias=PuestoVotacion::query()->orderBy('nombre','ASC')->get();

        $array=[];
        $i=1;
        foreach ($dependencias as $dependencia){
            array_push($array,[
                'nombre'=>$dependencia->nombre,
                'number'=>$i,
                'estado'=>$dependencia->estado,
                'id'=>$dependencia->id,
                'created_at'=>$dependencia->created_at,
                'updated_at'=>$dependencia->updated_at
            ]);

            $i++;
        }
        return $array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre=$request->nombre;
        $dependencia=new PuestoVotacion();
        $dependencia->nombre=$nombre;
        $dependencia->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre=$request->nombre;
        $dependencia=PuestoVotacion::find($id);
        $dependencia->nombre=$nombre;
        $dependencia->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
       return PuestoVotacion::destroy($id);
    }

    public function estado(Request $request){
        $id=$request->id;

        $dependencia=PuestoVotacion::find($id);
        $estado=$dependencia->estado;
        if ($estado){
            $dependencia->estado=0;
        }else{
            $dependencia->estado=1;
        }

        $dependencia->save();


    }
}
