<!--Pantalla principal para un resultado de un trabajador-->
@extends("layouts.template")

@section("contenido") 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Resultados del Trabajador: {{$resultado->worker_id}}</h1>      
  </div>
   
    <table class="table" >      
      <tbody>
        <tr >
          <th scope="row">Id</th>
          <td>{{$resultado->id}}</td>         
        </tr>
        <tr>
          <th scope="row">Trabajador_ID</th>
          <td> {{$resultado->worker_id}}</td>
        </tr>
        <tr>
          <th scope="row">Saturacion de Oxigeno</th>
          <td> {{$resultado->oxygen_saturation}}</td>
        </tr>
        <tr>
          <th scope="row">Temperatura</th>
          <td> {{$resultado->temperature}}</td>
        </tr>
        <tr>
          <th scope="row">Fecha</th>
          <td> {{$resultado->created_at}}</td>
        </tr>        
      </tbody>
    </table>

@endsection
