@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Matrícula ') }} {{ $process->code }} {{ __(' > Listado de alumnos') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>
                <th width="350">Nombre completo</th>
                <th width="150">Código</th>
                <th width="220">Cursos matriculados</th>
                <th width="150">Estado</th>
                <th>Matricular</th>
            </thead>
            <tbody>
                @if ($students->count())
                    @foreach ($students as $student)
                    <tr>
                        <td></td>
                        <td>{{ $student->name.' '.$student->lastname }}</td>
                        <td><center>{{ $student->code }}</center></td>
                        <td><center>{{ $student->cantEnrollments($process->id).'/8' }}</center></td>
                        <td><center>{{ $student->is_blocked ? 'Bloqueado' : 'Desbloqueado' }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('EnrollmentController@edit', $student->id) }}" ><span class="glyphicon glyphicon-star"></span></a></center></td>
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
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection