@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Listado de procesos de matrícula') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="180">Semestre</th>
                <th width="180">Fecha inicio</th>
                <th width="180">Fecha fin</th>
                <th width="180">Estado</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                @if ($processes->count())
                    @foreach ($processes as $process)
                    <tr>
                        <td></td>
                        <td><center>{{ $process->code }}</center></td>
                        <td><center>{{ date('d-m-Y', strtotime($process->start_at)) }}</center></td>
                        <td><center>{{ date('d-m-Y', strtotime($process->end_at)) }}</center></td>
                        <td><center>{{ $process->is_closed ? 'Cerrado' : 'Aperturado' }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('ProcessController@edit', $process->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                        <td>
                            <center>
                            <form action="{{ action('ProcessController@destroy', $process->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el proceso de matrícula seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
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
        {{$processes->links()}}
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('processes.create') }}" class="btn-effie" style="margin-bottom:30px">Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection