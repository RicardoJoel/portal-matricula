@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Matrícula ') }} {{ $process->code }} {{ __(' > Listado de secciones aperturadas') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="300">Curso</th>
                <th width="100">Sección</th>
                <th width="300">Docente</th>
                <th width="220">Alumnos matriculados</th>
                <th>Seleccionar</th>
            </thead>
            <tbody>
                @inject('sections','App\Services\Sections')
                @foreach ($sections->get() as $section)
                <tr>
                    <td></td>
                    <td>{{ $section->course->name.' ('.$section->course->code.')' }}</td>
                    <td><center>{{ $section->code }}</center></td>
                    <td>{{ $section->teacher->lastname.', '.$section->teacher->name }}</td>
                    <td><center>{{ $section->quantity.'/'.'10' }}</center></td>
                    <td>
                        <center>
                        <form method="POST" action="{{ route('enrollments.store') }}" method="form">
                            @csrf
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="section_id" value="{{ $section->id }}">
                            <button class="btn btn-secondary btn-xs" type="submit"><span class="glyphicon glyphicon-check"></span></button>
                        </form>
                        </center>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Matrícula ') }} {{ $process->code }} {{ __(' > Alumno ') }} {{ $student->code.' - '.$student->name.' '.$student->lastname }} {{ __(' > Secciones matriculadas') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <p>
            <i class="fa fa-info-circle fa-icon" aria-hidden="true" style="padding:5px"></i>
            <b>Nota</b>: Solo puede matricular al alumno hasta en ocho (8) secciones de diferentes cursos.
        </p>
    </div>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <table id="tbl-sections" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="350">Curso</th>
                <th width="110">Sección</th>
                <th width="300">Docente</th>
                <th width="200">Fecha inscripción</th>
                <th>Retirar</th>
            </thead>
            <tbody>
                @inject('enrollments','App\Services\Enrollments')
                @foreach ($enrollments->get($process->id, $student->id) as $enrollment)
                <tr>
                    <td></td>
                    <td>{{ $enrollment->course }}</td>
                    <td><center>{{ $enrollment->section }}</center></td>
                    <td>{{ $enrollment->teacher }}</td>
                    <td><center>{{ $enrollment->date }}</center></td>
                    <td>
                        <center>
                        <form action="{{ action('EnrollmentController@destroy', $enrollment->id) }}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar la inscripción seleccionada?')"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                        </center>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('enrollments.index') }}" class="btn-effie-inv">Terminar</a>
        </center>
    </div>
</div>
@endsection
