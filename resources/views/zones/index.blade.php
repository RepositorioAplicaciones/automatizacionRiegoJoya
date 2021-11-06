<!-- vista de inicio de los Zonas -->
@extends("layouts.template")

@section("contenido") 
  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Lista de zonas</h1>
  @if(Auth::user()->role_id < 3)  
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">        
        <a href="zones/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Zonas</a>
      </div>  
      <div class="btn-group mr-2">   
        <button class="btn btn-success" aria-pressed="true">Cargar Resultado</button>
      </div>
      <div class="btn-group mr-2">   
         <input type="file" onchange="readFile(this)">
      </div>
      
      <div class="btn-group mr-2">        
        @csrf            
        <a class="btn btn-danger" href="{{ route('zones.download') }}">Exportar txt</a>        
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
    //funcion para borrar una zona
    var row; 
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
    

    $(".btn-success").click(function(e){
        e.preventDefault();
              
        
        row= temp.split('\r\n')
        var i = 0;
        while (i<=row.length)
        {

          if (row[i] == "")
          {
            break;
          
          }
          else{
            getRequest(i);
            i=i+2;          
          }
        }
        
    });
    
    function getRequest(i)
    {
      var csrf = document.querySelector('meta[name="csrf-token"]').content;
      var data={
          zone_id :    row[i].substring(4,5),
          humedad : row[i].substring(7,9),
          temperatura  : row[i+1].substring(7,9),         
          _token:csrf
        };
        $.ajax({
           type:'POST',
             url : "{{ route('zones.load') }}",
           data:data,
           success:function(data){
               window.location.reload();
               alert('carga realizada exitosamente');
           }
        });
    }


    $(".btn-secondary").click(function(e){
        e.preventDefault();
             
        var csrf = document.querySelector('meta[name="csrf-token"]').content;
        
        $.ajax({
           type:'GET',
             url : "{{ route('zones.download') }}",
           data: "",
           success:function(data){
               window.location.reload();
               alert('descarga realizada exitosamente');
           }
        });
    });
    


   function readFile(input) {       
        var file = input.files[0];
        var reader = new FileReader();
          reader.onload = function(){
            temp = reader.result;

            console.log(reader.result.substring(0, 200).split('\r\n'));
        };
          reader.onerror = function() {
          console.log(reader.error);
        };
        reader.readAsText(input.files[0]);
       
       }
  </script>

@endsection



