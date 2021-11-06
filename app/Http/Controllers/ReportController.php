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
use App\Models\Zone;

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
        $zonas = Zone::pluck('description', 'id');
        $request = (object)['DNI' => 0, 'temperature' => 0, 'oxygen_saturation' => 0];   
        return view("reports.index", compact("trabajador", "request", "resultados","zonas"));
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
        try
        {
        Auth::user()->authorizeRoles(['user', 'administrador', 'operador']);
        
        $resultados = Result::where('zone_id',$request->zone_id)->get();
        return Excel::download((new ResultsExportForm($resultados)), 'resultado.xlsx');
        }
        catch(Exception $e)
        {
        return $resultados;
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

    
   
   
}
