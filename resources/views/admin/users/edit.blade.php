<!--Editar un usuario específico-->
@extends("layouts.template")

@section("contenido") 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar usuario</h1>            
    </div>
  
    {!! Form::model($usuario, ['method' => 'PATCH', 'action' => ['App\Http\Controllers\AdminUserController@update', $usuario->id]]) !!}
        <table>
            <tr>
                <td>{!! Form::label('name', 'Nombre') !!} </td>
                <td>{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!} </td>
            </tr>
           
            <tr>
                <td>{!! Form::label('email', 'Email') !!} </td>
                <td>{!! Form::email('email', null, ['class' => 'form-control','required']) !!} </td>
            </tr>

            <!-- Por si se desea cambiar el password directamente (no recomendado)
            <tr>
                <td>{//!! //Form::label('password', 'Contraseña') !!} </td>
                <td>{//!! Form::password('password', ['class' => 'form-control','required']) !!} </td>

                Para recoger el password
                Form::input('password', 'name', 'value')
            </tr>
            -->  
            <tr>
                <td>{!! Form::label('role_id', 'Rol') !!} </td>
                <td>{!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}</td>
            </tr>            

            <tr>
                <td >{!! Form::submit('Modificar Usuario', ['class' => 'btn btn-primary' ]) !!} </td>
                <td>{!! Form::reset('Restaurar', ['class' => 'btn btn-danger' ]) !!} </td>
            </tr>            

        </table>
    {!! Form::close() !!}
@endsection
