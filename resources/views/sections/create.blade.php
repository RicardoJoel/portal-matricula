@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Matrícula ') }} {{ $process->code }} {{ __(' > Nueva sección') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('sections.store') }}" role="form">
				@csrf
				<input type="hidden" name="process_id" value="{{ $process->id }}">

				<div class="fila">
					<div class="columna columna-3">
						<label>Curso*</label>
						@inject('courses','App\Services\Courses')
						<select name="course_id" id="course_id" required>
							<option selected disabled hidden value="">Seleccione un curso</option>
							@foreach ($courses->get() as $index => $course)
							<option value="{{ $index }}" {{ old('course_id') == $index ? 'selected' : '' }}>
								{{ $course }}
							</option>
							@endforeach
						</select>					
					</div>
					<div class="columna columna-3">
						<label>Docente*</label>
						@inject('teachers','App\Services\Teachers')
						<select name="teacher_id" id="teacher_id" required>
							<option selected disabled hidden value="">Seleccione un docente</option>
							@foreach ($teachers->get() as $index => $teacher)
							<option value="{{ $index }}" {{ old('teacher_id') == $index ? 'selected' : '' }}>
								{{ $teacher }}
							</option>
							@endforeach
						</select>					
					</div>
					<div class="columna columna-3">
						<label>Código</label>
						<input type="text" name="code" id="code" placeholder="Autogenerado" disabled>
					</div>
					<div class="columna columna-3">
						<label>Estado</label>
						<select name="is_closed" id="is_closed" disabled>
							<option value="0" selected>Aperturado</option>
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
								<li>El código y estado de la sección son autogenerados.</li>
								<li>Luego de creada la sección, solo padrá cambiar el docente y estado.</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Registrar</button>
						<a href="{{ route('sections.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection