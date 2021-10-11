<?php

namespace App\Http\Controllers;
use App\Exports\WorkersExport;
use App\Exports\ResultsExport;
use App\Exports\ResultsExportForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Worker;
use App\Models\Result;

//Controlador para la gestion de los reportes y archivos

//class ReportController extends Controller  implements FromCollection
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);   
        $trabajador = [];
        $resultados = [];
        $request = (object)['DNI' => 0, 'temperature' => 0, 'oxygen_saturation' => 0];   
        return view("reports.index", compact("trabajador", "request", "resultados"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //QUERY PARA conseguir los datos del form del index de results                
        $resultados = [];      
        $trabajador = Worker::where('DNI', $request->DNI)->get();
        if(count($trabajador)){ 
            foreach ($trabajador[0]->results as $result){
                if($request->tempRadio == "mayor" && $request->satOxiRadio == "mayor"){
                    if($result->temperature >= $request->temperature && $result->oxygen_saturation >= $request->oxygen_saturation){
                        array_push($resultados, $result);
                    }
                }elseif($request->tempRadio == "menor" && $request->satOxiRadio == "menor"){
                    if($result->temperature <= $request->temperature && $result->oxygen_saturation <= $request->oxygen_saturation){
                        array_push($resultados, $result);
                    }
                }elseif($request->tempRadio == "menor" && $request->satOxiRadio == "mayor"){
                    if($result->temperature <= $request->temperature && $result->oxygen_saturation >= $request->oxygen_saturation){
                        array_push($resultados, $result);
                    }
                }elseif($request->tempRadio == "mayor" && $request->satOxiRadio == "menor"){
                    if($result->temperature >= $request->temperature && $result->oxygen_saturation <= $request->oxygen_saturation){
                        array_push($resultados, $result);
                    }
                } 
            }
        }
        
        return view("reports.index", compact("trabajador", "resultados", "request"));       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
               
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
             
    }

    
    public function exportWorker() 
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);      
        return Excel::download(new WorkersExport, 'trabajadores.xlsx');
    }

    public function exportResult() 
    {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);      
        return Excel::download((new ResultsExport), 'resultados.xlsx');
    }

    public function exportResultForm($request) 
    {       
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        $resultados = json_decode($request);               
        return Excel::download((new ResultsExportForm($resultados)), 'resultado_trabajador.xlsx');       
    }
}
