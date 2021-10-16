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
use \App\Models\Zone;
use Exception;
use App\Http\Controllers\Response;
use App\Http\Controllers\str;

//Controlador para la gestion de los Zonas

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $zonas=Zone::all();        
        return view("zones.index", compact("zonas"));           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);        
       
        return view('zones.create');

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
        $zone = new Zone();        
        $zone ->name = $request->name;
        $zone ->description = $request->description;
        $zone->save();        
        return redirect("/zones");
    }
    
    public function load(Request $request)
    {
        
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
   
        try
        {
        $resultado = new Result;
        $resultado ->zone_id = 1;
        $resultado ->humedad = $request->humedad1;
        $resultado ->temperatura = $request->temperatura1;        
        $resultado ->date = now();        
        $resultado->save();

        $resultado1 = new Result;
        $resultado1 ->zone_id = 2;
        $resultado1 ->humedad = $request->humedad2;
        $resultado1 ->temperatura = $request->temperatura2;
        $resultado1 ->date = now();        
        $resultado1->save();
        }
        catch(Exception $e)
        {
            return $e;

        }

        return $resultado1;
          
        //return redirect("/zones"); 
        
    }

    public function getDownload(Request $request) {
        try
        {
        // prepare content
        $zonas1 = Zone::findOrFail(1); 
        $zonas2 = Zone::findOrFail(2); 
        $content = "Logs \n";
        $a = count((array)$zonas1);
        $b = count((array)$zonas2);

        //$humedad = Result::withavg('results','humedad')->where('zone_id', '=', 1)->orderBy('id', 'desc')->take(2)->get();
        $p = 0;
        $resultshum = Result::where('zone_id', '=', 1)->orderBy('id', 'desc')->take(2)->get(); 
        $resultstem= Result::where('zone_id', '=', 1)->orderBy('id', 'desc')->take(1)->get()->toarray(); 
        foreach ($resultshum as $results) {
            
            // $prom = $prom +  $results->humedad;
             //$content .= $zonas1[$a-2]->humedad;
             //$content.= "\n";
           $p = $p + $results->humedad;
           }
          $valor = ($p); 

        //$humedad = Result::select("zona_id")->withAvg('results', 'humedad')->where('zone_id', '=', 1)->orderBy('id', 'desc')->take(2)->get();
                        


        //$promedio = $humedad::withAvg('results','humedad') ->get();   
        //$temperatura = Result::where('zone_id', '=', 1)->orderBy('id', 'desc')->take(1)->get();
        //$prom = 0;

        //foreach ($humedad as $result) {
            
         // $prom = $prom +  $results->humedad;
          //$content .= $zonas1[$a-2]->humedad;
          //$content.= "\n";
        //}
     //   $valor =($prom/2);
    /*
        // file name that will be used in the download
        $fileName = "zonas.txt";
    
        // use headers in order to generate the download
        $headers = [
          'Content-type' => 'text/plain', 
          'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
          'Content-Length' => sizeof($content)
        ];*/
    
        // make a response, with the content, a 200 response code and the headers
        return  $valor; //Response::make($content, 200, $headers);

        }
        catch(Exception $e)
        {
            return $e;
        }
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
        $zonas = Zone::findOrFail($id);
        return view("zones.view", compact("zonas"));        
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
        $zonas = Zone::findOrFail($id);       
        return view("zones.edit",compact("zonas")); 
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
        $zonas = Zone::findOrFail($id);        
        $zonas ->name = $request->name;
        $zonas ->description = $request->description;
       
        $zonas->update();
      
        return redirect("/zones");
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
        $zonas = Zone::findOrFail($id);
        //$zonas->results()->delete();
        $zonas ->delete(); 
        
    }
}
