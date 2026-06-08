@extends('corporativo.layout')

@section('title', 'Servicios - SERVIMETAL')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('corporativo.inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Servicios</li>
        </ol>
    </div>
</nav>

<section>
    <div class="container">
        <div class="section-title">
            <h2>Nuestros Servicios</h2>
            <p>Soluciones completas para tus necesidades industriales</p>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-hammer" style="color: var(--color-primary);"></i> Fabricación Metalmecánica</h5>
                        <p class="card-text">Ofrecemos servicios completos de diseño y fabricación de:</p>
                        <ul>
                            <li>Estructuras metálicas</li>
                            <li>Componentes industriales</li>
                            <li>Máquinas especiales</li>
                            <li>Equipos personalizados</li>
                        </ul>
                        <p class="text-muted">Utilizamos tecnología de punta y personal altamente capacitado.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-tools" style="color: var(--color-primary);"></i> Mantenimiento Industrial</h5>
                        <p class="card-text">Servicios de mantenimiento para optimizar tu producción:</p>
                        <ul>
                            <li>Mantenimiento preventivo</li>
                            <li>Mantenimiento correctivo</li>
                            <li>Inspecciones periódicas</li>
                            <li>Reparaciones especializadas</li>
                        </ul>
                        <p class="text-muted">Equipo disponible 24/7 para emergencias.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-building" style="color: var(--color-primary);"></i> Montaje y Construcción</h5>
                        <p class="card-text">Especialistas en proyectos de construcción industrial:</p>
                        <ul>
                            <li>Montaje de estructuras</li>
                            <li>Instalación de equipos</li>
                            <li>Proyectos llave en mano</li>
                            <li>Supervisión de obras</li>
                        </ul>
                        <p class="text-muted">Cumplimiento garantizado de normas y estándares.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-headset" style="color: var(--color-primary);"></i> Asesoría y Consultoría</h5>
                        <p class="card-text">Orientación experta para tus proyectos:</p>
                        <ul>
                            <li>Diseño y ingeniería</li>
                            <li>Análisis de viabilidad</li>
                            <li>Gestión de proyectos</li>
                            <li>Capacitación técnica</li>
                        </ul>
                        <p class="text-muted">Soluciones adaptadas a tus necesidades específicas.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light p-4 rounded mt-5">
            <h4 class="mb-3" style="color: var(--color-primary);">¿Necesitas un servicio personalizado?</h4>
            <p>Contacta con nuestro equipo para discutir tu proyecto y obtener una propuesta a medida.</p>
            <a href="{{ route('corporativo.contacto') }}" class="btn btn-primary">Solicitar Presupuesto</a>
        </div>
    </div>
</section>
@endsection
