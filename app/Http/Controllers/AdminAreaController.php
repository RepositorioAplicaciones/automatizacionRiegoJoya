<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\Area;
use \App\Models\Role;

//Controlador para la gestion de areas de las areas

class AdminAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $areas = Area::all();
        return view("admin.areas.index", compact("areas"));          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['user', 'administrador']);        
        return view('admin.areas.create');        
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
        $area = new Area;        
        $area ->name = $request->name;        
        $area->save();

        return redirect("/admin/areas");
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
        $area = Area::findOrFail($id);
        return view("admin.areas.view", compact("area"));        
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
        $area = Area::findOrFail($id);
        return view("admin.areas.edit", compact("area")); 
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
        $area = Area::findOrFail($id);        
        $area ->name = $request->name;
        
        $area->update();
      
        return redirect("/admin/areas");
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
        $area = Area::findOrFail($id);
        $area ->delete();        
    }
}
