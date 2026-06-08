@extends('layouts.admin')
@section('title', 'Ver Solicitud - SERVIMETAL')
@section('content')
<h1 class="mb-4">Detalle de la Solicitud</h1>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">Información General</div>
            <div class="card-body">
                <p><strong>Cliente:</strong> {{ $solicitud->cliente->nombre_razon_social }}</p>
                <p><strong>Servicio:</strong> {{ $solicitud->servicio->nombre_servicio }}</p>
                <p><strong>Responsable:</strong> {{ $solicitud->usuario->nombres }}</p>
                <p><strong>Fecha:</strong> {{ $solicitud->fecha_solicitud->format('d/m/Y H:i') }}</p>
                <p><strong>Estado:</strong> <span class="badge {{ $solicitud->estado === 'FINALIZADO' ? 'bg-success' : ($solicitud->estado === 'CANCELADO' ? 'bg-danger' : ($solicitud->estado === 'EN_PROCESO' ? 'bg-warning' : 'bg-info')) }}">{{ $solicitud->estado }}</span></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Detalles</div>
            <div class="card-body">
                <p><strong>Detalle:</strong></p>
                <p>{{ $solicitud->detalle ?? '-' }}</p>
                <p><strong>Observaciones:</strong></p>
                <p>{{ $solicitud->observacion ?? '-' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Acciones</div>
            <div class="card-body">
                <a href="{{ route('solicitudes.edit', $solicitud->id_solicitud) }}" class="btn btn-warning w-100"><i class="fas fa-edit"></i> Editar</a>
                <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary w-100 mt-2"><i class="fas fa-arrow-left"></i> Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
