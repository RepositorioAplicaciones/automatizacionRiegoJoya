<!--Crear un resultado específico de un resultado a zonas-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Añadir resultado a zonas {{$zonas->name}}</h1>           
    </div>

    {!! Form::open(['method' => 'POST', 'url' => 'zones/'.$zonas->id.'/results']) !!}
        <table>
            <tr>
                <td>{!! Form::label('zone_id', 'Trabajador ID') !!} </td>
                <td>{!! Form::text('zone_id', $zonas->id, ['class' => 'form-control', 'required', 'readonly']) !!} </td>
            </tr>
            
            <tr>
                <td>{!! Form::label('humedad', 'Humedad de la zona') !!} </td>
                <td>{!! Form::number('humedad', null, ['class' => 'form-control', 'required','step' => '0.1']) !!} </td>
            </tr>

            <tr>
                <td>{!! Form::label('temperatura', 'Temperatura ') !!} </td>
                <td>{!! Form::number('temperatura', null, ['class' => 'form-control', 'required' , 'step' => '0.1']) !!} </td>
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
