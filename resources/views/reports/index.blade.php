<!-- Vista para importar o exportar archivos -->
@extends("layouts.template")

@section("contenido") 
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Reportes</h1>    
  </div>    
  
  <div class="d-inline-flex p-2">
    <div class="card bg-light">
        <div class="card-header">
          <h5 class = "h5">Exportar información de Trabajadores</h5>
        </div>
        <div class="card-body text-center">        
            @csrf            
            <a class="btn btn-danger" href="{{ route('exportWorker') }}">Exportar Información</a>        
        </div>
    </div>
  </div>  
  
  <div class="d-inline-flex p-2">
    <div class="card bg-light">
        <div class="card-header">
          <h5 class = "h5">Exportar información de Resultados</h5>
        </div>
        <div class="card-body text-center">        
            @csrf            
            <a class="btn btn-danger" href="{{ route('exportResult') }}">Exportar Información</a>        
        </div>
    </div>
  </div> 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultas</h1>    
  </div>
  

  {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ReportController@store']) !!}
  
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
      <div class="col-sm-10">
        {!! Form::number('DNI', $request->DNI, ['class' => 'form-control', 'required']) !!}        
      </div>
    </div>

    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Temperatura</label>
      <div class="col-sm-10">
        {!! Form::number('temperature', $request->temperature, ['class' => 'form-control', 'required','step' => '0.01']) !!} 
        
          <div class="row col-sm-2 ">
              <div class="form-check  col-sm-5">
                <input class="form-check-input" type="radio" name="tempRadio" id="tempRadio1" value="mayor" checked>
                <label class="form-check-label" for="gridRadios1">
                  Mayor
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="tempRadio" id="tempRadio2" value="menor">
                <label class="form-check-label" for="gridRadios2">
                  Menor
                </label>
              </div>
          </div>
           
      </div>
    </div>

    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Saturación de Oxígeno</label>
      <div class="col-sm-10">
        {!! Form::number('oxygen_saturation', $request->oxygen_saturation, ['class' => 'form-control', 'required','step' => '0.01']) !!}  
        <fieldset class="form-group">
          <div class="row col-sm-2 col-form-label">
              <div class="form-check col-sm-5">
                <input class="form-check-input" type="radio" name="satOxiRadio" id="satOxiRadio1" value="mayor" checked>
                <label class="form-check-label" for="gridRadios1">
                  Mayor
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="satOxiRadio" id="satOxiRadio2" value="menor">
                <label class="form-check-label" for="gridRadios2">
                  Menor
                </label>
              </div>
          </div>
        </fieldset>      
      </div>
    </div>
    
    {!! Form::submit('Consultar', ['class' => 'btn btn-primary' ]) !!}    
    <?php $exportarResultados = json_encode($resultados);?>
    <a href="exportResultForm/{{$exportarResultados}}" class="btn  btn-danger">Exportar</a>  
  {!! Form::close() !!}
  
  <br>


  @if(count($trabajador))
    <h5 class = "h5">{{$trabajador[0]->name}} DNI: {{$trabajador[0]->DNI}}</h5>
    <table class="table " id="id_table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Temperatura</th>
          <th scope="col">Saturación de Oxigeno</th>
          <th scope="col">Fecha Tomada</th>
        </tr>
      </thead>
      <tbody>
        @foreach($resultados as $resultado)
          <tr>        
            <td>{{$resultado->temperature}}</td>
            <td>{{$resultado->oxygen_saturation}}</td>      
            <td>{{$resultado->date}}</td>      
          </tr>
        @endforeach
      </tbody>
    </table>
  @else     
    <h5 class = "h5">No existe ese DNI</h5>
  @endif
  
@endsection



