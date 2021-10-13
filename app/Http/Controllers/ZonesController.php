<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\Roster;
use \App\Models\Area;
use \App\Models\Worker;
use \App\Models\Result;

//Controlador para la gestion de los trabajadores

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $trabajadores=Worker::all();        
        return view("workers.index", compact("trabajadores"));           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);        
        $areas = Area::pluck('name', 'id');
        $rosters = Roster::pluck('name', 'id');
        $sex = array('hombre' => 'hombre', 'mujer' => 'mujer', 'otro' => 'otro');        
        return view('workers.create', compact("areas", "rosters", "sex"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $worker = new Worker();        
        $worker ->name = $request->name;
        $worker ->age = $request->age;
        $worker ->sex = $request->sex;
        $worker ->DNI = $request->DNI;
        $worker ->area_id = $request->area_id;
        $worker ->roster_id = $request->roster_id;
        $worker ->fecha_subida = $request->fecha_subida;
        $worker ->fecha_bajada = $request->fecha_bajada;        

        $worker->save();        

        return redirect("/workers");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $trabajador = Worker::findOrFail($id);
        return view("workers.view", compact("trabajador"));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);        
        $trabajador = Worker::findOrFail($id);
        $areas = Area::pluck('name', 'id');
        $rosters = Roster::pluck('name', 'id'); 
        $sex = array('hombre' => 'hombre', 'mujer' => 'mujer', 'otro' => 'otro');  
        return view("workers.edit", compact("trabajador", "areas", "rosters", "sex")); 
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
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $trabajador = Worker::findOrFail($id);        
        $trabajador ->name = $request->name;
        $trabajador ->age = $request->age;
        $trabajador ->sex = $request->sex;
        $trabajador ->DNI = $request->DNI;
        $trabajador ->area_id = $request->area_id;
        $trabajador ->roster_id = $request->roster_id;
        $trabajador ->fecha_subida = $request->fecha_subida;
        $trabajador ->fecha_bajada = $request->fecha_bajada;
        
        $trabajador->update();
      
        return redirect("/workers");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $trabajador = Worker::findOrFail($id);
        $trabajador->results()->delete();
        $trabajador ->delete(); 
    }
}
