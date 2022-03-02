@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Editar docente') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('teachers.update',$teacher->id) }}" role="form">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				
				<div class="fila">
					<div class="columna columna-3">
						<label>Nombre*</label>
						<input type="text" name="name" id="name" maxlength="50" value="{{ old('name', $teacher->name) }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Apellido*</label>
						<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname', $teacher->lastname) }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>D.N.I.*</label>
						<input type="text" name="document" id="document" maxlength="8" value="{{ old('document', $teacher->document) }}" onkeypress="return checkNumber(event)" required>
					</div>
				</div>
				<div class="fila">
					<div class="columna columna-3">
						<label>Código</label>
						<input type="text" name="code" id="code" value="{{ old('code', $teacher->code) }}" disabled>
					</div>
					<div class="columna columna-3">
						<label>Estado</label>
						<select name="is_blocked" id="is_blocked">
							<option value="1" {{ old('is_blocked', $teacher->is_blocked) ? 'selected' : '' }}>Bloqueado</option>
							<option value="0" {{ old('is_blocked', $teacher->is_blocked) ? '' : 'selected' }}>Desbloqueado</option>
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
								<li>El tamaño máximo del nombre, apellidos y correo electrónico es cincuenta (50) caracteres.</li>
								<li>El correo electrónico no puede repetirse entre usuarios.</li>
								<li>El D.N.I debe estar compuesto por ocho (8) dígitos.</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Guardar</button>
						<a href="{{ route('teachers.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection