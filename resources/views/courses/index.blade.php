@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Listado de cursos') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="400">Nombre</th>
                <th width="150">Código</th>
                <th width="180">Horas de dictado</th>
                <th width="150">Estado</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                @if ($courses->count())
                    @foreach ($courses as $course)
                    <tr>
                        <td></td>
                        <td>{{ $course->name }}</td>
                        <td><center>{{ $course->code }}</center></td>
                        <td><center>{{ $course->hours }}</center></td>
                        <td><center>{{ $course->is_blocked ? 'Bloqueado' : 'Desbloqueado' }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('CourseController@edit', $course->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                        <td>
                            <center>
                            <form action="{{ action('CourseController@destroy', $course->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el curso seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        {{$courses->links()}}
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('courses.create') }}" class="btn-effie" style="margin-bottom:30px">Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection