<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\Worker;
use \App\Models\Result;
    
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
             
        $results = Result::where('worker_id', '=', $request->id)->orderBy('date', 'asc')->get();
        $trabajador = Worker::find($request->id);
        return view("workers.results.index", compact("results", "trabajador"));  
       
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $trabajador = Worker::find($id);
        return view('workers.results.create', compact("trabajador")); 
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
        $resultado ->worker_id = $request->worker_id;
        $resultado ->oxygen_saturation = $request->oxygen_saturation;
        $resultado ->temperature = $request->temperature;
        $resultado ->date = $request->date;        
        
        $resultado->save();

        return redirect('/workers/'.$request->worker_id.'/results'); 
       
    }
   
   
    public function load(Request $request)
    {
        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
   
        $resultado = new Result;
        $resultado ->worker_id = $request->worker_id;
        $resultado ->oxygen_saturation = $request->oxygen_saturation;
        $resultado ->temperature = $request->temperature;
        $resultado ->date = now();        
        $resultado->save();
        //return $resultado;
        $worker_id = $request->worker_id;         
        return redirect('/workers/'.$worker_id.'/results'); 
        
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
    public function show($id_worker, $id_result)
    {        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::findOrFail($id_result);        
        return view("workers.results.view", compact("resultado"));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_worker, $id_result)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::find($id_result);
        $resultado->date = str_replace(' ', 'T', $resultado->date);
        $resultado->date = substr($resultado->date, 0, strrpos($resultado->date, ':'));
               
        return view("workers.results.edit", compact("resultado"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_worker, $id_result)
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultado = Result::findOrFail($id_result);

        $resultado ->oxygen_saturation = $request->oxygen_saturation;
        $resultado ->temperature = $request->temperature;
        $resultado ->date = $request->date;        
        
        $resultado->update();     
        
        return redirect('/workers/'.$id_worker.'/results');         
   
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
