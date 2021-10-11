<!--Pantalla principal para los roster-->
@extends("layouts.template")

@section("contenido") 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Roster {{$roster->name}}</h1>      
  </div>
   
    <table class="table" >      
      <tbody>
        <tr >
          <th scope="row">Id</th>
          <td>{{$roster->id}}</td>         
        </tr>
        <tr>
          <th scope="row">Nombre</th>
          <td> {{$roster->name}}</td>
        </tr>        
      </tbody>
    </table>

@endsection
