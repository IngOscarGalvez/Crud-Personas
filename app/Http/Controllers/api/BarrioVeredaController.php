<?php

namespace App\Http\Controllers\api;

use App\BarrioVereda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BarrioVeredaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BarrioVereda[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $dependencias=BarrioVereda::query()->orderBy('nombre','ASC')->get();

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
        $dependencia=new BarrioVereda();
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
        $dependencia=BarrioVereda::find($id);
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
       return BarrioVereda::destroy($id);
    }

    public function estado(Request $request){
        $id=$request->id;

        $dependencia=BarrioVereda::find($id);
        $estado=$dependencia->estado;
        if ($estado){
            $dependencia->estado=0;
        }else{
            $dependencia->estado=1;
        }

        $dependencia->save();


    }
}
