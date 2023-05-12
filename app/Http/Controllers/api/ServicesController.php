<?php

namespace App\Http\Controllers\api;

use App\BarrioVereda;
use App\Candidato;
use App\Departamento;
use App\Http\Controllers\Controller;
use App\Municipio;
use App\PuestoVotacion;
use App\Responsable;
use App\Vehiculo;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function listarDepartamentos($search)
    {
        $departamentos = Departamento::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($departamentos) > 0){
            foreach ($departamentos as $departamento) {
                array_push($array,[
                    'text' => $departamento->nombre
                ]);
            }
        }
        return $array;
    }

    public function listarMunicipios($depto,$search)
    {
        $departamento = Departamento::query()->where('nombre','like','%'.$depto.'%')->first();
        $municipios = Municipio::query()->where([['departamento_id',$departamento->id],['nombre','like','%'.$search.'%']])->get();
        $array = [];
        if(count($municipios) > 0){
            foreach ($municipios as $municipio) {
                array_push($array,[
                    'text' => $municipio->nombre
                ]);
            }
        }
        return $array;
    }

    public function listarBarrioVereda($search)
    {
        $barrioVeredas = BarrioVereda::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($barrioVeredas) > 0){
            foreach ($barrioVeredas as $barrioVereda) {
                array_push($array,[
                    'text' => $barrioVereda->nombre
                ]);
            }
        }
        return $array;
    }

    public function listarVehiculo($search)
    {
        $vehiculos = Vehiculo::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($vehiculos) > 0){
            foreach ($vehiculos as $vehiculo) {
                array_push($array,[
                    'text' => $vehiculo->nombre
                ]);
            }
        }
        return $array;
    }

    public function listarPuestoVotacion($search)
    {
        $puestoVotaciones = PuestoVotacion::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($puestoVotaciones) > 0){
            foreach ($puestoVotaciones as $puestoVotacion) {
                array_push($array,[
                    'text' => $puestoVotacion->nombre
                ]);
            }
        }
        return $array;
    }

    public function listarCandidatos($search)
    {
        $candidatos = Candidato::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($candidatos) > 0){
            foreach ($candidatos as $candidato) {
                array_push($array,[
                    'text' => $candidato->nombre
                ]);
            }
        }
        return $array;
    }
    public function listarResponsables($search)
    {
        $responsables = Responsable::query()->where('nombre','like','%'.$search.'%')->get();
        $array = [];
        if(count($responsables) > 0){
            foreach ($responsables as $responsable) {
                array_push($array,[
                    'text' => $responsable->nombre
                ]);
            }
        }
        return $array;
    }
}
