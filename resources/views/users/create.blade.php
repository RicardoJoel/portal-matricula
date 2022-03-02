@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Nuevo usuario') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('register') }}" role="form">
				@csrf				
				<div class="fila">
					<div class="columna columna-3">
						<label>Nombre*</label>
						<input type="text" name="name" id="name" maxlength="50" value="{{ old('name') }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Apellido*</label>
						<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname') }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Correo electrónico*</label>
						<input type="email" name="email" id="email" maxlength="50" value="{{ old('email') }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" required>
					</div>
					<div class="columna columna-3">
						<label>Estado</label>
						<select name="is_blocked" id="is_blocked" disabled>
							<option value="0" selected>Desbloqueado</option>
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
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Registrar</button>
						<a href="{{ route('users.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection