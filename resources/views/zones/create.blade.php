<!--Crear una zona específico-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Crear Zonas</h1>           
    </div>
  
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ZonesController@store']) !!}
        <table>
            <tr>
                <td>{!! Form::label('name', 'Nombre') !!} </td>
                <td>{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('description', 'Descripción') !!} </td>
                <td>{!! Form::text('description', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>            

           

            <tr>
                <td >{!! Form::submit('Crear Zona', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Borrar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            

        </table>
    {!! Form::close() !!}
@endsection
