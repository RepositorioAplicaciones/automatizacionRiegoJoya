<!-- vista de inicio de los Zonas -->
@extends("layouts.template")

@section("contenido") 
  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Lista de zonas</h1>
  @if(Auth::user()->role_id < 3)  
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">        
        <a href="workers/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Zonas</a>
      </div>     
    </div>
  @endif
</div>

  @if(count($zonas))
  
  <table class="table " id="id_table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Resultados</th>
        @if(Auth::user()->role_id < 3)
          <th scope="col">Opciones</th>
        @endif          
      </tr>
    </thead>
    <tbody>

    @foreach($zonas as $zonas)
      <tr>
        <td>{{$zonas->name}}</td>
        <td>{{$zonas->description}}</td>
        <td><a href= "/zones/{{ $zonas -> id }}/results"> resultado </a></td>
        @if(Auth::user()->role_id < 3)
          <td>
            <a href= "{{route('zones.show', $zonas -> id) }}"> Ver </a> &nbsp;
            <a href= "{{route('zones.edit', $zonas -> id) }}"> Editar </a> &nbsp;
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <a href="{{ route('zones.destroy', $zonas->id) }}" data-method="delete" class="jquery-postback">Delete</a>
          </td> 
        @endif
      </tr>
    @endforeach 

    </tbody>
  </table>
    
  @else
    {{"No existen zonas registrados"}}
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

      var result = confirm("Estas seguro que deseas eliminar la zona: " +  indice.substring(indice.lastIndexOf('/') + 1,indice.size) + "???");
            
      if(result){        
    
        $.post({
            type: $this.data('method'),
            url: $this.attr('href')
        }).done(function (data) {
            alert('registro borrado exitosamente');
            console.log(data);
            window.location.reload();
        });
      }      
    });
    
  </script>

@endsection



