@extends('layouts.app')

@section('title', 'Dashboard - SERVIMETAL')

@section('content')
<div class="mb-4">
    <h1 class="mb-2">Bienvenido a SERVIMETAL</h1>
    <p class="text-muted">Sistema de Gestión de Inventarios y Servicios</p>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users fa-2x mb-3" style="color: #007bff;"></i></h5>
                <h6>Total de Usuarios</h6>
                <h2 class="text-primary">{{ \App\Models\Usuario::count() }}</h2>
                <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-tie fa-2x mb-3" style="color: #28a745;"></i></h5>
                <h6>Total de Clientes</h6>
                <h2 class="text-success">{{ \App\Models\Cliente::count() }}</h2>
                <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-success">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-box fa-2x mb-3" style="color: #ffc107;"></i></h5>
                <h6>Total de Materiales</h6>
                <h2 class="text-warning">{{ \App\Models\Material::count() }}</h2>
                <a href="{{ route('materiales.index') }}" class="btn btn-sm btn-warning">Ver</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-wrench fa-2x mb-3" style="color: #17a2b8;"></i></h5>
                <h6>Total de Servicios</h6>
                <h2 class="text-info">{{ \App\Models\Servicio::count() }}</h2>
                <a href="{{ route('servicios.index') }}" class="btn btn-sm btn-info">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-tasks fa-2x mb-3" style="color: #6f42c1;"></i></h5>
                <h6>Solicitudes Pendientes</h6>
                <h2 class="text-primary">{{ \App\Models\SolicitudServicio::where('estado', 'PENDIENTE')->count() }}</h2>
                <a href="{{ route('solicitudes.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-exchange-alt fa-2x mb-3" style="color: #dc3545;"></i></h5>
                <h6>Movimientos Recientes</h6>
                <h2 class="text-danger">{{ \App\Models\MovimientoInventario::count() }}</h2>
                <a href="{{ route('movimientos.index') }}" class="btn btn-sm btn-danger">Ver</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Información del Sistema</h5>
            </div>
            <div class="card-body">
                <p><strong>Aplicación:</strong> SERVIMETAL - Sistema de Gestión de Inventarios y Servicios</p>
                <p><strong>Versión:</strong> 1.0.0</p>
                <p><strong>Descripción:</strong> Plataforma web corporativa para la gestión integral de inventarios, servicios y solicitudes de la empresa SERVIMETAL A&M S.A.C.</p>
                <p class="text-muted mb-0"><em>Desarrollado con Laravel y MySQL</em></p>
            </div>
        </div>
    </div>
</div>
@endsection
