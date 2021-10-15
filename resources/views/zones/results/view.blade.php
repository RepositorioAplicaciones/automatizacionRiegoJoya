<!--Pantalla principal para un resultado de un trabajador-->
@extends("layouts.template")

@section("contenido") 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Resultados del zona: {{$resultado->zone_id}}</h1>      
  </div>
   
    <table class="table" >      
      <tbody>
        <tr >
          <th scope="row">Id</th>
          <td>{{$resultado->id}}</td>         
        </tr>
        <tr>
          <th scope="row">Zona_ID</th>
          <td> {{$resultado->zone_id}}</td>
        </tr>
        <tr>
          <th scope="row">Humedad</th>
          <td> {{$resultado->humedad}}</td>
        </tr>
        <tr>
          <th scope="row">Temperatura</th>
          <td> {{$resultado->temperatura}}</td>
        </tr>
        <tr>
          <th scope="row">Fecha</th>
          <td> {{$resultado->created_at}}</td>
        </tr>        
      </tbody>
    </table>

@endsection
