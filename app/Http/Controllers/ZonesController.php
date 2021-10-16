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
use Response;
use File;


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
    public function getDownload(Request $request) {
        try
        {
        $content = "";
                
        $result1 = $this->ObtenerPuntaje(1);
        $result2 = $this->ObtenerPuntaje(2);
        $content .= 'A,'.$result1.',B,'.$result2;
        $content .= "\n";
        
        $fileName = "zonas.txt";
        
        File::put(public_path('/uploads/'.$fileName),$content);
    
        
        $headers = [
          'Content-type' => 'text/plain', 
          'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
          'Content-length'=>strlen($content)
        ];
    
        
        return Response::download(public_path('/uploads/'.$fileName), $fileName,$headers);
        }
        catch(Exception $e)
        {
            return $e;
        }
    }
    public function ObtenerPuntaje($zone_id)
    {   
        $resultshum = Result::where('zone_id', '=', $zone_id)->orderBy('id', 'desc')->take(2)->get(); 
        
        $p1= 0; 
        $result = 0;
        foreach ($resultshum as $results) {           
           $p1 = $p1 + $results->humedad;
           }                      
        $valor = ($p1)/2; 
       if ($valor<=20)
        {
            $result = '60';
        }else if ($valor>20 and $valor<=40)
        {
            $result = '30';
        }
        else if ($valor>40 and $valor<=60)
        {
            $result = '15';
        }
        else if ($valor>60 and $valor<=80)
        {
            $result = '10';
        }
        else if ($valor>80 and $valor<=90)
        {
            $result = '5';
        }
        else if ($valor>90)
        {
            $result = '0';
        }
        return $result;
    } 
}
