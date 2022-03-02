@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Nuevo proceso de matrícula') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ route('processes.store') }}" role="form">
				@csrf				
				<div class="fila">
					<div class="columna columna-4">
						<label>Semestre*</label>
						<select name="code" id="code" required>
							<option value="{{ Carbon\Carbon::now()->subHours(5)->format('Y-1') }}" {{ old('code') == Carbon\Carbon::now()->subHours(5)->format('Y-1') ? 'selected' : '' }}>{{ Carbon\Carbon::now()->subHours(5)->format('Y-1') }}</option>
							<option value="{{ Carbon\Carbon::now()->subHours(5)->format('Y-2') }}" {{ old('code') == Carbon\Carbon::now()->subHours(5)->format('Y-2') ? 'selected' : '' }}>{{ Carbon\Carbon::now()->subHours(5)->format('Y-2') }}</option>
						</select>
					</div>
					<div class="columna columna-4">
						<label>Fecha inicio*</label>
						<input type="date" name="start_at" id="start_at" value="{{ old('start_at', Carbon\Carbon::now()->subHours(5)->format('Y-m-d')) }}" required>
					</div>
					<div class="columna columna-4">
						<label>Fecha fin*</label>
						<input type="date" name="end_at" id="end_at" value="{{ old('end_at', Carbon\Carbon::now()->subHours(5)->format('Y-m-d')) }}" required>
					</div>
					<div class="columna columna-4">
						<label>Estado</label>
						<select name="is_blocked" id="is_blocked" disabled>
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
								<li>Solo se permite registrar nuevos procesos de matrícula mientras no haya uno abierto.</li>
								<li>La fecha inicio debe ser anterior o igual a la fecha fin y posterior o igual a la fecha actual.</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Registrar</button>
						<a href="{{ route('processes.index') }}" class="btn-effie-inv">Cancelar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection