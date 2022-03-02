@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Matrícula ') }} {{ $process->code }} {{ __(' > Editar sección') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('sections.update',$section->id) }}" role="form">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				
				<div class="fila">
					<div class="columna columna-4">
						<label>Curso</label>
						<input type="text" value="{{ $section->course->name.' ('.$section->course->code.')' }}" readonly>					
					</div>
					<div class="columna columna-4">
						<label>Docente*</label>
						@inject('teachers','App\Services\Teachers')
						<select name="teacher_id" id="teacher_id" required>
							<option selected disabled hidden value="">Seleccione un docente</option>
							@foreach ($teachers->get() as $index => $teacher)
							<option value="{{ $index }}" {{ old('teacher_id', $section->teacher_id) == $index ? 'selected' : '' }}>
								{{ $teacher }}
							</option>
							@endforeach
						</select>					
					</div>
					<div class="columna columna-4">
						<label>Código</label>
						<input type="text" name="code" id="code" value="{{ old('code', $section->code) }}" readonly>
					</div>
					<div class="columna columna-4">
						<label>Estado</label>
						<select name="is_closed" id="is_closed">
							<option value="1" {{ old('is_closed', $section->is_closed) ? 'selected' : '' }}>Cerrado</option>
							<option value="0" {{ old('is_closed', $section->is_closed) ? '' : 'selected' }}>Aperturado</option>
						</select>
					</div>
				</div>
				<div class="fila">
					<div class="columna columna-1">
						<p>
							<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
							<b>Importante</b>
							<ul>
								<li>(*) Campos obligatorios.</li>
								<li>El curso y código de la sección son ineditables.</li>
								<li>Puede cambiar el docente y estado de la sección.</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Guardar</button>
						<a href="{{ route('sections.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection