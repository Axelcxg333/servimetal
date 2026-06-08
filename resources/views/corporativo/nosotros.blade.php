@extends('corporativo.layout')

@section('title', 'Nosotros - SERVIMETAL')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('corporativo.inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Nosotros</li>
        </ol>
    </div>
</nav>

<section>
    <div class="container">
        <div class="section-title">
            <h2>Sobre SERVIMETAL</h2>
            <p>Conoce nuestra historia, misión y valores</p>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500" class="img-fluid rounded" alt="Nuestra Empresa">
            </div>
            <div class="col-md-6 ps-md-4">
                <h3 style="color: var(--color-primary);">Nuestra Historia</h3>
                <p>SERVIMETAL A&M S.A.C. fue fundada en 2008 con la visión de proporcionar soluciones de calidad en metalmecánica a las industrias peruanas. Desde entonces, hemos crecido significativamente gracias a nuestro compromiso con la excelencia.</p>
                <p>Nuestro equipo multidisciplinario ha trabajado en diversos sectores incluyendo minería, manufactura, construcción y petróleo.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-bullseye fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h5 class="card-title">Nuestra Misión</h5>
                        <p class="card-text">Proporcionar soluciones integrales de metalmecánica de alta calidad que contribuyan al desarrollo industrial del país.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h5 class="card-title">Nuestra Visión</h5>
                        <p class="card-text">Ser la empresa líder en soluciones metalmecánicas, reconocida por nuestra calidad, innovación y servicio al cliente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-heart fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h5 class="card-title">Nuestros Valores</h5>
                        <p class="card-text">Calidad, Compromiso, Integridad, Innovación y Responsabilidad Social son los pilares de nuestras operaciones.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h4 style="color: var(--color-primary);">¿Por qué elegirnos?</h4>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="fas fa-check-circle" style="color: var(--color-primary);"></i> <strong>Experiencia:</strong> +15 años en el mercado industrial</li>
                    <li class="mb-3"><i class="fas fa-check-circle" style="color: var(--color-primary);"></i> <strong>Profesionalismo:</strong> Equipo certificado y capacitado</li>
                    <li class="mb-3"><i class="fas fa-check-circle" style="color: var(--color-primary);"></i> <strong>Calidad:</strong> Estándares internacionales de producción</li>
                    <li class="mb-3"><i class="fas fa-check-circle" style="color: var(--color-primary);"></i> <strong>Puntualidad:</strong> Cumplimiento garantizado de plazos</li>
                </ul>
            </div>
            <div class="col-md-6 mb-4">
                <h4 style="color: var(--color-primary);">Nuestras Estadísticas</h4>
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h2 style="color: var(--color-primary);">150+</h2>
                        <p>Proyectos Completados</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 style="color: var(--color-primary);">50+</h2>
                        <p>Clientes Satisfechos</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 style="color: var(--color-primary);">40+</h2>
                        <p>Profesionales</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h2 style="color: var(--color-primary);">99%</h2>
                        <p>Satisfacción Cliente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
