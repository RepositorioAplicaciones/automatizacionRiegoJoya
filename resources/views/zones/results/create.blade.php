<!--Crear un resultado específico de un resultadod e un trabajador-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Añadir Resultado al trabajador {{$trabajador->name}}</h1>           
    </div>

    {!! Form::open(['method' => 'POST', 'url' => 'workers/'.$trabajador->id.'/results']) !!}
        <table>
            <tr>
                <td>{!! Form::label('worker_id', 'Trabajador ID') !!} </td>
                <td>{!! Form::text('worker_id', $trabajador->id, ['class' => 'form-control', 'required', 'readonly']) !!} </td>
            </tr>
            
            <tr>
                <td>{!! Form::label('oxygen_saturation', 'Saturación de Oxígeno') !!} </td>
                <td>{!! Form::number('oxygen_saturation', null, ['class' => 'form-control', 'required','step' => '0.1']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('temperature', 'Temperatura ') !!} </td>
                <td>{!! Form::number('temperature', null, ['class' => 'form-control', 'required' , 'step' => '0.1']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('date', 'Fecha') !!} </td>
                <td>{!! Form::datetimeLocal('date', null, [ 'class' => 'form-control', 'required']) !!} </td>
            </tr>
            <tr>
                <td >{!! Form::submit('Añadir Resultado', ['class' => 'btn btn-primary']) !!} </td>
                <td>{!! Form::reset('Borrar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            

        </table>
    {!! Form::close() !!}
  
@endsection
