<!--Editar un area específica-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Area</h1>            
    </div>
  
    {!! Form::model($area, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\AdminAreaController@update', $area->id]]) !!}
        <table>
            <tr>
                <td>{!! Form::label('name', 'Nombre') !!} </td>
                <td>{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>           
            
            <tr>
                <td >{!! Form::submit('Modificar Area', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Restaurar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            

        </table>
    {!! Form::close() !!}
@endsection
