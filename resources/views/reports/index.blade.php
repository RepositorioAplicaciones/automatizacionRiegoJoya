<!-- Vista para importar o exportar archivos -->
@extends("layouts.template")

@section("contenido") 
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reportes</h1>    
  </div>    
  
  
  
  <div class="d-inline-flex p-2">
    <div class="card bg-light">
        <div class="card-header">
          <h5 class = "h5">Exportar información de Resultados</h5>
          {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ReportController@store']) !!}
          <div class="form-group row">
          {!! Form::select('zone_id', $zonas, null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Exportar', ['class' => 'btn btn-primary' ]) !!}    
        {!! Form::close() !!}
    </div>
  </div> 
  </div>
  
  

  
  
  
  
@endsection



