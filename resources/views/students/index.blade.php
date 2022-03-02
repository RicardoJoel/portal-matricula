@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Listado de alumnos') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="400">Nombre completo</th>
                <th width="150">D.N.I.</th>
                <th width="150">Código</th>
                <th width="120">Estado</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                @if ($students->count())
                    @foreach ($students as $student)
                    <tr>
                        <td></td>
                        <td>{{ $student->name.' '.$student->lastname }}</td>
                        <td><center>{{ $student->document }}</center></td>
                        <td><center>{{ $student->code }}</center></td>
                        <td><center>{{ $student->is_blocked ? 'Bloqueado' : 'Desbloqueado' }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('StudentController@edit', $student->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                        <td>
                            <center>
                            <form action="{{ action('StudentController@destroy', $student->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el alumno seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                            </center>
                        </td>
                    </tr>
                    @endforeach 
                @else
                <tr>
                    <td colspan="8">No hay registros.</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{$students->links()}}
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('students.create') }}" class="btn-effie" style="margin-bottom:30px">Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection