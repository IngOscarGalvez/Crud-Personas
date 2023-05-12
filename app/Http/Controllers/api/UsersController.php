<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Scan;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $user = Auth::user();
        $user_id=$user->id;

        $rol=$user->roles->implode('name',', ');
        return User::with('roles')->get();



    }

    public function listarRoles(){
        return Role::where('name','<>','Admin')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->name;
        $email=$request->email;
        $pass=$request->password;
        $rol=$request->rol;


        $user=User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pass),

        ]);

        switch ($rol){

            case 2:
                $user->assignRole('Asesor');
                break;

        }


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        // busco los escaneo pertinentes que tiene el usuario en su trabajo
//        $scans=Scan::where('user_id','=',$id)->get();
//        foreach ($scans as $scan){
//            $scan->user_id = '1';
//            $scan->save();
//        }

        $user=User::destroy($id);
    }

    public function selectUser(Request $request)
    {
        $id=$request->id;
        $user=User::with('roles')->where('id','=',$id)->first();
        $rol=$user->roles->implode('name',', ');
        return $array=[
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'rol'=>$rol,



        ];
    }

    public function getRolUser()
    {
        $user = Auth::user();
        return $rol=$user->roles->implode('name',', ');
    }




    public function UpdateUser(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $parent_id=$request->parent_id;

        $user = User::find($request->id);
        $user->name = $name;
        $user->email=$email;



        if ($password != ''){
            $user->password=Hash::make($password);
        }

        $user->save();


    }


}
