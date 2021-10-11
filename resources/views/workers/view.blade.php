<!--Pantalla principal para los trabajadores-->
@extends("layouts.template")

@section("contenido") 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Trabajador: {{$trabajador->name}}</h1>      
  </div>
   
    <table class="table" >      
      <tbody>
        <tr >
          <th scope="row">Id</th>
          <td>{{$trabajador->id}}</td>         
        </tr>
        <tr>
          <th scope="row">Nombre</th>
          <td> {{$trabajador->name}}</td>
        </tr>
        <tr>
          <th scope="row">Edad</th>
          <td> {{$trabajador->age}}</td>
        </tr>
        <tr>
          <th scope="row">Sexo</th>
          <td> {{$trabajador->sex}}</td>
        </tr>
        <tr>
          <th scope="row">DNI</th>
          <td> {{$trabajador->DNI}}</td>
        </tr>
        <tr>
          <th scope="row">Area</th>
          <td> {{$trabajador->area->name}}</td>
        </tr>
        <tr>
          <th scope="row">Roster</th>
          <td> {{$trabajador->roster->name}}</td>
        </tr> 
        <tr>
          <th scope="row">Fecha de Subida</th>
          <td> {{$trabajador->fecha_subida}}</td>
        </tr>  
        <tr>
          <th scope="row">Fecha de Bajada</th>
          <td> {{$trabajador->fecha_bajada}}</td>
        </tr>         
      </tbody>
    </table>

@endsection
