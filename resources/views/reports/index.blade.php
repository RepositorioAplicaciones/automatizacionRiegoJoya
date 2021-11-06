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
        </div>
        {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ReportController@store']) !!}
  
    
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Zonas</label>
      {!! Form::select('id', $zonas, null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Consultar', ['class' => 'btn btn-primary' ]) !!}    
    <?php $exportarResultados = json_encode($resultados);?>
    <a href="exportResultForm/{{$exportarResultados}}" class="btn  btn-danger">Exportar</a>  
  {!! Form::close() !!}
        <div class="card-body text-center">        
            @csrf            
            <a class="btn btn-danger" href="{{ route('exportResult') }}">Exportar Información</a>        
        </div>
    </div>
  </div> 

  
  

  
  
  
  
@endsection



