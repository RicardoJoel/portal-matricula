@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Menú principal') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <h6 class="title3">Matrícula de alumnos y Administración de cuenta</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('enrollments.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-check-square fa-4x fa-icon'></i>                            
                            <h6>Inscripciones</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Inscripciones</h6>
                            <p>Inscribe alumnos en los procesos de matrícula.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">    
            <div class="card">
                <a href="{{ route('profile') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-user fa-4x fa-icon'></i>                            
                            <h6>Información personal</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Información personal</h6>
                            <p>Actualiza tus datos generales y de contacto.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('password') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-lock fa-4x fa-icon'></i>                            
                            <h6>Seguridad</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Seguridad</h6>
                            <p>Actualiza tu contraseña regularmente.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<link rel='stylesheet' href="{{ asset('css/cards.css') }}">
<script>
var cards = document.querySelectorAll('.card');
cards.forEach((card) => {
    card.addEventListener('mouseover', ()=>{
        card.classList.toggle('is-flipped');
    });
    card.addEventListener('mouseout', ()=>{
        card.classList.toggle('is-flipped');
    });
});
</script>
@endsection