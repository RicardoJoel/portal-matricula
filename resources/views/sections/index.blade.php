@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Listado de secciones > ') }} {{ $process ? 'Matrícula '.$process->code : 'No hay matrícula' }} {{ __(' aperturada') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="100">Matrícula</th>
                <th width="300">Curso</th>
                <th width="100">Sección</th>
                <th width="300">Docente</th>
                <th width="120">Estado</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                @if ($sections->count())
                    @foreach ($sections as $section)
                    <tr>
                        <td></td>
                        <td><center>{{ $section->process->code }}</center></td>
                        <td>{{ $section->course->name.' ('.$section->course->code.')' }}</td>
                        <td><center>{{ $section->code }}</center></td>
                        <td>{{ $section->teacher->lastname.', '.$section->teacher->name.' ('.$section->teacher->code.')' }}</td>
                        <td><center>{{ $section->is_closed ? 'Cerrado' : 'Aperturado' }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('SectionController@edit', $section->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                        <td>
                            <center>
                            <form action="{{ action('SectionController@destroy', $section->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar la sección seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        {{$sections->links()}}
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('sections.create') }}" class="btn-effie" style="margin-bottom:30px">Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection