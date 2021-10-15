<!--Editar un resultado específico-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar Resultado del zonas {{$resultado->zone_id}}</h1>         
    </div>
    
    {!! Form::model($resultado, ['method' => 'PATCH', 'url' => 'zones/'.$resultado->zone_id.'/results/'.$resultado->id]) !!}    
        <table>
            <tr>
                <td>{!! Form::label('zone_id', 'Zona ID') !!} </td>
                <td>{!! Form::text('zone_id', $resultado->zone_id, ['class' => 'form-control', 'required', 'disabled']) !!} </td>
            </tr>
            
            <tr>
                <td>{!! Form::label('humedad', 'Humedad') !!} </td>
                <td>{!! Form::number('humedad', null, ['class' => 'form-control', 'required','step' => '0.1']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('temperatura', 'Temperatura ') !!} </td>
                <td>{!! Form::number('temperatura', null, ['class' => 'form-control', 'required' , 'step' => '0.1']) !!} </td>
            </tr>
            
            <tr>
                <td>{!! Form::label('date', 'Fecha') !!} </td>
                <td>{!! Form::datetimeLocal('date', $resultado->date, ['class' => 'form-control', 'required']) !!} </td>
            </tr>
            <tr>
                <td >{!! Form::submit('Modificar Resultado', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Borrar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>  

        </table>
    {!! Form::close() !!}
@endsection
