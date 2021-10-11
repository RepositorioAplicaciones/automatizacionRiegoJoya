<!--Crear un area específica-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Crear area</h1>           
    </div>
  
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\AdminAreaController@store']) !!}
        @csrf
        <table>
            <tr>
                <td>{!! Form::label('name', 'Nombre') !!} </td>
                <td>{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>
           
            <tr>
                <td >{!! Form::submit('Crear Area', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Borrar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            
        </table>
    {!! Form::close() !!}
    
@endsection
