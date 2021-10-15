<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\Worker;
use \App\Models\Result;
use \App\Models\Zone;
    
// controlador principal de resultados

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador','supervisor']);
             
        $results = Result::where('zone_id', '=', $request->id)->orderBy('date', 'asc')->get();
        $zonas = Zone::find($request->id);
        return view("zones.results.index", compact("results", "zonas"));  
       
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $zonas = Zone::find($id);
        return view('zones.results.create', compact("zonas")); 
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
        $resultado = new Result;
        $resultado ->zone_id = $request->zone_id;
        $resultado ->humedad = $request->humedad;
        $resultado ->temperatura = $request->temperatura;
        $resultado ->date = $request->date;        
        
        $resultado->save();

        return redirect('/zones/'.$request->zone_id.'/results'); 
       
    }
   
   
    public function load(Request $request)
    {
        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
   
        $resultado = new Result;
        $resultado ->zone_id = $request->zone_id;
        $resultado ->humedad = $request->humedad;
        $resultado ->temperatura = $request->temperatura;
        $resultado ->date = now();        
        $resultado->save();
        //return $resultado;
        $zone_id = $request->zone_id;         
        return redirect('/zones/'.$zone_id.'/results'); 
        
    }
  
    public function apiload(Request $request)
    {
        
        //Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
   
        $resultado = new Result;
        $resultado ->worker_id = $request->worker_id;
        $resultado ->oxygen_saturation = $request->oxygen_saturation;
        $resultado ->temperature = $request->temperature;
        $resultado ->date = now();        
        $resultado->save();
        return response()->json(["message" => "CONFORME"], 201);
        //return $resultado;
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_zone, $id_result)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::findOrFail($id_result);        
        return view("zones.results.view", compact("resultado"));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_zone, $id_result)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::find($id_result);
        $resultado->date = str_replace(' ', 'T', $resultado->date);
        $resultado->date = substr($resultado->date, 0, strrpos($resultado->date, ':'));
               
        return view("zones.results.edit", compact("resultado"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_zone, $id_result)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::findOrFail($id_result);

        $resultado ->humedad = $request->humedad;
        $resultado ->temperatura = $request->temperatura;
        $resultado ->date = $request->date;        
        
        $resultado->update();     
        
        return redirect('/zones/'.$id_zone.'/results');         
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_worker, $id_result)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::findOrFail($id_result);
        $resultado ->delete();       
    }
    
}
