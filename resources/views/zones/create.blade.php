<!--Crear un trabajador específico-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Crear Trabajador x</h1>           
    </div>
  
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\WorkersController@store']) !!}
        <table>
            <tr>
                <td>{!! Form::label('name', 'Nombre') !!} </td>
                <td>{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('age', 'Edad') !!} </td>
                <td>{!! Form::number('age', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>            

            <tr>
                <td>{!! Form::label('sex', 'Sexo') !!} </td>
                <td>{!! Form::select('sex', $sex, null, ['class' => 'form-control']) !!}</td>
            </tr>

            <tr>
                <td>{!! Form::label('DNI', 'DNI') !!} </td>
                <td>{!! Form::number('DNI', null, ['class' => 'form-control', 'required' , 'max' => 99999999 ] ) !!} </td>
            </tr>  

            <tr>
                <td>{!! Form::label('area_id', 'Areas') !!} </td>
                <td>{!! Form::select('area_id', $areas, null, ['class' => 'form-control']) !!}</td>
            </tr>  

            <tr>
                <td>{!! Form::label('roster_id', 'Roster') !!} </td>
                <td>{!! Form::select('roster_id', $rosters, null, ['class' => 'form-control']) !!}</td>
            </tr>  

            <tr>
                <td>{!! Form::label('fecha_subida', 'Fecha de Subida') !!} </td>
                <td>{!! Form::date('fecha_subida', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>  

            <tr>
                <td>{!! Form::label('fecha_bajada', 'Fecha de Bajada') !!} </td>
                <td>{!! Form::date('fecha_bajada', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>  

            <tr>
                <td >{!! Form::submit('Crear Trabajador', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Borrar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            

        </table>
    {!! Form::close() !!}
@endsection
