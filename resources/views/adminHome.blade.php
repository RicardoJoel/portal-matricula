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
        <h6 class="title3">Mantenimiento de entidades</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('users.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-users fa-4x fa-icon'></i>                            
                            <h6>Usuarios</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Usuarios</h6>
                            <p>Visualiza y actualiza la lista de usuarios.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('students.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-graduation-cap fa-4x fa-icon'></i>                            
                            <h6>Alumnos</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Alumnos</h6>
                            <p>Visualiza y actualiza la lista de alumnos.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('teachers.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-briefcase fa-4x fa-icon'></i>                            
                            <h6>Docentes</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Docentes</h6>
                            <p>Visualiza y actualiza la lista de docentes.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('courses.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-book fa-4x fa-icon'></i>                            
                            <h6>Cursos</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Cursos</h6>
                            <p>Visualiza y actualiza la lista de cursos.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <h6 class="title3">Gestión de matrícula</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('processes.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-calendar fa-4x fa-icon'></i>                            
                            <h6>Procesos de matrícula</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Procesos de matrícula</h6>
                            <p>Apertura y actualiza procesos de matrícula.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('sections.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-th fa-4x fa-icon'></i>                            
                            <h6>Secciones</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Secciones</h6>
                            <p>Visualiza y actualiza la lista de secciones.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
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
                <a href="{{ route('enrollments.report') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-bar-chart fa-4x fa-icon'></i>                            
                            <h6>Reportes</h6>
                        </div>
                    </div>
                    <div class="card__face card__face--back">
                        <div class="content">
                            <h6>Reportes</h6>
                            <p>Genera reportes semestrales de matrícula.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="fila">
    <div class="space"></div>
    <div class="columna columna-1">
        <h6 class="title3">Administración de cuenta</h6>
    </div>
</div>
<div class="fila">
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