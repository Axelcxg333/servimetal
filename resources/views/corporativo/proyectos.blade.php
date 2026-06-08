@extends('corporativo.layout')

@section('title', 'Proyectos - SERVIMETAL')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('corporativo.inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Proyectos</li>
        </ol>
    </div>
</nav>

<section>
    <div class="container">
        <div class="section-title">
            <h2>Nuestros Proyectos</h2>
            <p>Algunos de nuestros proyectos más destacados</p>
        </div>

        <div class="row">
            @for($i = 1; $i <= 6; $i++)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=400&h=250&fit=crop" class="card-img-top" alt="Proyecto {{ $i }}">
                    <div class="card-body">
                        <h5 class="card-title">Proyecto Industrial {{ $i }}</h5>
                        <p class="card-text">Descripción breve del proyecto realizado. Incluyendo los servicios prestados y resultados obtenidos.</p>
                        <small class="text-muted">
                            <i class="fas fa-folder"></i> Fabricación | 
                            <i class="fas fa-calendar"></i> 2024
                        </small>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-5">
            <p class="lead">¿Deseas ver más detalles sobre nuestros proyectos?</p>
            <a href="{{ route('corporativo.contacto') }}" class="btn btn-primary btn-lg">Contáctanos</a>
        </div>
    </div>
</section>
@endsection
