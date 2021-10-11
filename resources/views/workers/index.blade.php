<!-- vista de inicio de los trabajadores -->
@extends("layouts.template")

@section("contenido") 
  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Lista de Trabajadores</h1>
  @if(Auth::user()->role_id < 3)  
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">        
        <a href="workers/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Trabajador</a>
      </div>     
    </div>
  @endif
</div>

  @if(count($trabajadores))
  
  <table class="table " id="id_table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Edad</th>
        <th scope="col">Sexo</th>
        <th scope="col">DNI</th>
        <th scope="col">Area</th>
        <th scope="col">Roster</th>
        <th scope="col">Fecha de Subida</th>
        <th scope="col">Fecha de Bajada</th>
        <th scope="col">Resultados</th>
        @if(Auth::user()->role_id < 3)
          <th scope="col">Opciones</th>
        @endif          
      </tr>
    </thead>
    <tbody>

    @foreach($trabajadores as $trabajador)
      <tr>
        <td>{{$trabajador->name}}</td>
        <td>{{$trabajador->age}}</td>
        <td>{{$trabajador->sex}}</td>
        <td>{{$trabajador->DNI}}</td>
        <td>{{$trabajador->area->name}}</td>
        <td>{{$trabajador->roster->name}}</td>
        <td>{{$trabajador->fecha_subida}}</td>
        <td>{{$trabajador->fecha_bajada}}</td>
        <td><a href= "/workers/{{ $trabajador -> id }}/results"> resultado </a></td>
        @if(Auth::user()->role_id < 3)
          <td>
            <a href= "{{route('workers.show', $trabajador -> id) }}"> Ver </a> &nbsp;
            <a href= "{{route('workers.edit', $trabajador -> id) }}"> Editar </a> &nbsp;
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <a href="{{ route('workers.destroy', $trabajador->id) }}" data-method="delete" class="jquery-postback">Delete</a>
          </td> 
        @endif
      </tr>
    @endforeach 

    </tbody>
  </table>
    
  @else
    {{"No existen trabajadores registrados"}}
  @endif   

  <script>
    //funcion para borrar un trabajador
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $(document).on('click', 'a.jquery-postback', function(e) {   
      
      e.preventDefault();   
      var $this = $(this);
      var indice = $this[0].toString();

      var result = confirm("Estas seguro que deseas eliminar al trabajador: " +  indice.substring(indice.lastIndexOf('/') + 1,indice.size) + "???");
            
      if(result){        
    
        $.post({
            type: $this.data('method'),
            url: $this.attr('href')
        }).done(function (data) {
            alert('Usuario borrado exitosamente');
            console.log(data);
            window.location.reload();
        });
      }      
    });
    
  </script>

@endsection



