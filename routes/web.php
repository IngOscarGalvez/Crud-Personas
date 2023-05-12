<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::group(['middleware' => ['role:Admin']], function () {

    // Frontend Admin
    Route::get('/admin/users', 'SpaController@index');
    Route::get('/admin/dependencias', 'SpaController@index');
    Route::get('/admin/barrioVereda', 'SpaController@index');
    Route::get('/admin/personas', 'SpaController@index');
    Route::get('/admin/vehiculo', 'SpaController@index');
    Route::get('/admin/puestoVotacion', 'SpaController@index');
    Route::get('/admin/candidato', 'SpaController@index');
    Route::get('/admin/responsable', 'SpaController@index');
    Route::get('/admin/personas/create', 'SpaController@index');
    Route::get('/admin/personas/edit/{id}', 'SpaController@index');
    Route::get('/admin/reuniones', 'SpaController@index');
    Route::get('/admin/reuniones/asistencia/{id}', 'SpaController@index');
    Route::get('/admin/personas/cumple', 'SpaController@index');

    Route::Resources([
        'users'=>'api\UsersController',
        'dependencias'=>'api\DependenciaController',
        'barrioVereda'=>'api\BarrioVeredaController',
        'vehiculo'=>'api\VehiculoController',
        'puestoVotacion'=>'api\PuestoVotacionController',
        'candidato'=>'api\CandidatoController',
        'responsable'=>'api\ResponsableController',
        'Reunion'=>'api\ReunionController',
    ]);

    Route::post('/dependencias/estado', 'api\DependenciaController@estado');
    Route::post('/barrioVereda/estado', 'api\BarrioVeredaController@estado');
    Route::post('/vehiculo/estado', 'api\VehiculoController@estado');
    Route::post('/puestoVotacion/estado', 'api\PuestoVotacionController@estado');
    Route::post('/candidato/estado', 'api\CandidatoController@estado');
    Route::post('/responsable/estado', 'api\ResponsableController@estado');
    Route::post('/Reunion/estado', 'api\ReunionController@estado');


    Route::get('/listarroles', 'api\UsersController@listarRoles');
    Route::get('/user/getrole', 'api\UsersController@getRolUser');
    Route::post('/user/select', 'api\UsersController@selectUser');
    Route::post('/user/updateUser', 'api\UsersController@UpdateUser');
    Route::post('/user/updateUser', 'api\UsersController@UpdateUser');

    Route::get('/listarDepartamentos/{search}', 'api\ServicesController@listarDepartamentos');
    Route::get('/listarMunicipios/{depto}/{search}', 'api\ServicesController@listarMunicipios');
    Route::get('/listarbarrioVereda/{search}', 'api\ServicesController@listarBarrioVereda');
    Route::get('/listarVehiculo/{search}', 'api\ServicesController@listarVehiculo');
    Route::get('/listarpuestoVotacion/{search}', 'api\ServicesController@listarPuestoVotacion');
    Route::get('/listarCandidatos/{search}', 'api\ServicesController@listarCandidatos');
    Route::get('/listarResponsables/{search}', 'api\ServicesController@listarResponsables');

    Route::post('/persona', 'api\PersonaController@store');
    Route::get('/persona/{id}', 'api\PersonaController@edit');
    Route::put('/persona/{id}', 'api\PersonaController@update');
    Route::get('/persona', 'api\PersonaController@index');
    Route::post('/personas/getdata', 'PersonasTableController@table');
    Route::post('/personas/getdata/cumple', 'PersonasTableController@tableCumple');

    Route::post('/personas/foto_perfil/{id}', 'api\PersonaController@subirFoto');
    Route::post('/personas/cumpleannos', 'api\PersonaController@personasCumpleannos');

    Route::get('/admin/reuniones/{id}', 'api\ReunionAsistenciaController@getReunion');
    Route::get('/admin/reuniones-personas/{identificacion}', 'api\ReunionAsistenciaController@getPersona');
    Route::post('/admin/reuniones-asistencia/create', 'api\ReunionAsistenciaController@asistenciaPersona');
    Route::get('/admin/reuniones-asistencia/personas/{id}', 'api\ReunionAsistenciaController@index');
    Route::delete('/admin/reuniones-asistencia/personas/{id}', 'api\ReunionAsistenciaController@destroy');
});


Route::group(['middleware' => ['role:Admin|User']], function () {

    Route::get('/acount', 'api\AcountContoller@AcountUser');


});

Route::group(['middleware' => ['role:User']], function () {




});


Route::get('/', function () {
    return redirect('/login');
});


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index');
