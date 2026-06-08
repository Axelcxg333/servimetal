@extends('layouts.admin')
@section('title', 'Ver Servicio - SERVIMETAL')
@section('content')
<h1 class="mb-4">Detalle del Servicio</h1>
<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $servicio->nombre_servicio }}</p>
        <p><strong>Descripción:</strong> {{ $servicio->descripcion ?? '-' }}</p>
        <p><strong>Precio Referencial:</strong> {{ $servicio->precio_referencial ? 'S/ ' . number_format($servicio->precio_referencial, 2) : '-' }}</p>
        <p><strong>Estado:</strong> <span class="badge {{ $servicio->estado === 'ACTIVO' ? 'bg-success' : 'bg-danger' }}">{{ $servicio->estado }}</span></p>
        <a href="{{ route('servicios.edit', $servicio->id_servicio) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
@endsection
