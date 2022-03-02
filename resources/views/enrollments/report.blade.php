@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Generador de reportes') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="formulario-inscripcion">
		<form method="GET" action="{{ route('enrollments.generate') }}">
            <div class="fila">
                <div class="columna columna-4">
                    <label>Semestre</label>
                    @inject('processes','App\Services\Processes')
                    <select name="process_id">
                        <option selected value="">Todos los semestres</option>
                        @foreach ($processes->all() as $index => $process)
                        <option value="{{ $index }}" {{ $process_id == $index ? 'selected' : '' }}>
                            {{ $process }}
                        </option>
                        @endforeach
                    </select>					
                </div>
                <div class="columna columna-4">
                    <label>Curso</label>
                    @inject('courses','App\Services\Courses')
                    <select name="course_id">
                        <option selected value="">Todos los cursos</option>
                        @foreach ($courses->all() as $index => $course)
                        <option value="{{ $index }}" {{ $course_id == $index ? 'selected' : '' }}>
                            {{ $course }}
                        </option>
                        @endforeach
                    </select>					
                </div>
                <div class="columna columna-4">
                    <label>Sección</label>
                    @inject('sections','App\Services\Sections')
                    <select name="section_id">
                        <option selected value="">Todas las secciones</option>
                        @foreach ($sections->all() as $index => $section)
                        <option value="{{ $index }}" {{ $section_id == $index ? 'selected' : '' }}>
                            {{ $section }}
                        </option>
                        @endforeach
                    </select>					
                </div>
                <div class="columna columna-4">
                    <label>Docente</label>
                    @inject('teachers','App\Services\Teachers')
                    <select name="teacher_id">
                        <option selected value="">Todos los docentes</option>
                        @foreach ($teachers->all() as $index => $teacher)
                        <option value="{{ $index }}" {{ $teacher_id == $index ? 'selected' : '' }}>
                            {{ $teacher }}
                        </option>
                        @endforeach
                    </select>					
                </div>
            </div>
            <div class="fila">
                <div class="space"></div>
                <div class="columna columna-1">
                    <center>
                    <button type="submit" class="btn-effie">Generar</button>
                    <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>
                <th width="120">Semestre</th>
                <th width="300">Curso</th>
                <th width="120">Sección</th>
                <th width="300">Docente</th>
                <th>Alumnos matriculados</th>
            </thead>
            <tbody>
                @if ($items->count())
                    @foreach ($items as $item)
                    <tr>
                        <td></td>
                        <td><center>{{ $item->process }}</center></td>
                        <td>{{ $item->course }}</td>
                        <td><center>{{ $item->section }}</center></td>
                        <td>{{ $item->teacher }}</td>
                        <td><center>{{ $item->quantity }}</center></td>
                    </tr>
                    @endforeach 
                @else
                <tr>
                    <td colspan="8">Sin resultados encontrados.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection