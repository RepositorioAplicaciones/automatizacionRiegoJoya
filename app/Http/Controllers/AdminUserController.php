<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\Role;

//Controlador para la gestion de usuarios con roles

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $usuarios = User::with('role')->select('users.*')->join('roles', 'roles.id', '=', 'users.role_id')->get();
        return view("admin.users.index", compact("usuarios"));          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact("roles"));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $usuario = new User;
        $usuario ->role_id = $request->role_id;
        $usuario ->name = $request->name;
        $usuario ->email = $request->email;
        $usuario ->password = Hash::make($request->password);
        $usuario->save();

        return redirect("/admin/users");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {         
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $usuario = User::with('role')->select('users.*')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', $id)->get();        
        
        return view("admin.users.view", compact("usuario"));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $roles = Role::pluck('name', 'id');
        $usuario = User::findOrFail($id);
        return view("admin.users.edit", compact("roles", "usuario")); 
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
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $usuario = User::findOrFail($id);
        $usuario ->role_id = $request->role_id;
        $usuario ->name = $request->name;
        $usuario ->email = $request->email;

        //no recomendable cambiar el password desde un form, usar recuperable de laravel auth
        #$usuario ->password = Hash::make($request->password);

        $usuario->update();

        return redirect("/admin/users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador']);
        $usuario = User::findOrFail($id);
        if($usuario->role->name != "administrador"){           
           $usuario ->delete();        
        }
    }
}
