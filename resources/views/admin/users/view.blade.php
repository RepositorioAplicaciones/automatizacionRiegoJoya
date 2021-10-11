<!--Pantalla principal para los usuario-->
@extends("layouts.template")

@section("contenido") 

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuario {{$usuario[0]->name}}</h1>      
  </div>
 
  @if(count($usuario))
    @foreach ($usuario as $user)      
    
    <table class="table" >      
      <tbody>
        <tr >
          <th scope="row">Id</th>
          <td>{{ $user->id }}</td>         
        </tr>
        <tr>
          <th scope="row">Nombre</th>
          <td> {{ $user->name }}</td>
        </tr>
        <tr>
          <th scope="row">Email</th>
          <td>{{ $user->email }}</td>
        </tr>
        <tr>
          <th scope="row">Role</th>
          <td>{{ $user->role->name }}</td>
        </tr>
      </tbody>
    </table>

    @endforeach
  @else
    {{"No existen trabajadores registrados"}}
  @endif
  
@endsection
