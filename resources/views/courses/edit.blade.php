@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Editar curso') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('courses.update',$course->id) }}" role="form">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				
				<div class="fila">
					<div class="columna columna-3">
						<label>Nombre*</label>
						<input type="text" name="name" id="name" maxlength="50" value="{{ old('name', $course->name) }}" onkeypress="return checkText(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Código*</label>
						<input type="text" name="code" id="code" maxlength="6" value="{{ old('code', $course->code) }}" onkeypress="return checkAlNum(event)" onkeyup="return mayusculas(this)" required>
					</div>
					<div class="columna columna-3">
						<label>Horas de dictado*</label>
						<input type="number" name="hours" id="hours" value="{{ old('hours', $course->hours) }}" onkeypress="return checkNumber(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Estado</label>
						<select name="is_blocked" id="is_blocked">
							<option value="1" {{ old('is_blocked', $course->is_blocked) ? 'selected' : '' }}>Bloqueado</option>
							<option value="0" {{ old('is_blocked', $course->is_blocked) ? '' : 'selected' }}>Desbloqueado</option>
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
								<li>El tamaño máximo del nombre es cincuenta (50) caracteres.</li>
								<li>El código no puede repetirse entre cursos.</li>
								<li>Las horas de dictado es un número entre uno (1) y cien (100).</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Guardar</button>
						<a href="{{ route('courses.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection