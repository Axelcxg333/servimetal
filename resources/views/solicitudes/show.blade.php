@extends('layouts.admin')
@section('title', 'Detalle de Solicitud')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Solicitud SOL-{{ str_pad($solicitud->id_solicitud, 4, '0', STR_PAD_LEFT) }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('solicitudes.edit', $solicitud->id_solicitud) }}" class="btn-c-primary"><i class="fas fa-pen me-1"></i> Editar</a>
        <a href="{{ route('solicitudes.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>
</div>
<div class="breadcrumb-c mb-4">
    <a href="{{ route('solicitudes.index') }}">Solicitudes</a>
    <span class="mx-1">›</span>
    <span class="active">SOL-{{ str_pad($solicitud->id_solicitud, 4, '0', STR_PAD_LEFT) }}</span>
</div>

<div class="row g-3">
    <div class="col-md-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Información del Servicio</h6>
            <div class="row g-2">
                <div class="col-6"><div class="form-label-c">Cliente</div><div>{{ $solicitud->cliente->nombre_razon_social ?? '-' }}</div></div>
                <div class="col-6"><div class="form-label-c">Tipo de Servicio</div><div>{{ $solicitud->servicio->nombre_servicio ?? '-' }}</div></div>
                <div class="col-6"><div class="form-label-c">Prioridad</div><div>{{ $solicitud->prioridad }}</div></div>
                <div class="col-6"><div class="form-label-c">Estado</div><div>
                    @php
                        $cls = match($solicitud->estado) {
                            'EN_PROCESO' => 'badge-soft-info',
                            'ATENDIDA', 'FINALIZADO' => 'badge-soft-success',
                            'PENDIENTE' => 'badge-soft-warning',
                            'CANCELADO' => 'badge-soft-danger',
                            default => 'badge-soft-info',
                        };
                    @endphp
                    <span class="{{ $cls }}">{{ $solicitud->estado }}</span>
                </div></div>
                <div class="col-6"><div class="form-label-c">Registrado por</div><div>{{ $solicitud->usuario->nombres ?? '-' }} {{ $solicitud->usuario->apellidos ?? '' }}</div></div>
            </div>
        </div>
        <div class="card-c mt-3">
            <h6 class="fw-bold mb-3">Detalle</h6>
            <p class="mb-0">{{ $solicitud->detalle ?? 'Sin detalle' }}</p>
            @if($solicitud->observacion)
                <hr>
                <h6 class="fw-bold">Observaciones</h6>
                <p class="mb-0">{{ $solicitud->observacion }}</p>
            @endif
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Fechas</h6>
            <div class="row g-2">
                <div class="col-12"><div class="form-label-c">Fecha de Solicitud</div><div>{{ optional($solicitud->fecha_solicitud)->format('d/m/Y H:i') }}</div></div>
                <div class="col-12"><div class="form-label-c">Fecha Requerida</div><div>{{ optional($solicitud->fecha_requerida)->format('d/m/Y') }}</div></div>
            </div>
        </div>
        <div class="card-c mt-3">
            <h6 class="fw-bold mb-3">Cambiar Estado</h6>
            <form action="{{ route('solicitudes.cambiarEstado', $solicitud->id_solicitud) }}" method="POST">
                @csrf @method('PUT')
                <div class="d-flex gap-2 flex-wrap">
                    @foreach(['PENDIENTE', 'EN_PROCESO', 'ATENDIDA', 'FINALIZADO', 'CANCELADO'] as $est)
                        <button type="submit" name="estado" value="{{ $est }}" class="btn-sm-c {{ $solicitud->estado === $est ? 'btn-sm-primary' : 'btn-sm-light' }}" {{ $solicitud->estado === $est ? 'disabled' : '' }}>
                            {{ match($est) { 'EN_PROCESO' => 'En Proceso', 'ATENDIDA' => 'Atendida', default => ucfirst(strtolower($est)) } }}
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn-sm-c { display: inline-block; padding: .3rem .7rem; border-radius: 20px; font-size: .8rem; text-decoration: none; font-weight: 500; border: none; cursor: pointer; }
.btn-sm-primary { background: #0d6efd; color: #fff; }
.btn-sm-light { background: #f3f4f6; color: #1f2937; border: 1px solid #d1d5db; }
.btn-sm-light:hover { background: #e5e7eb; }
.btn-sm-c:disabled { opacity: .5; cursor: default; }
</style>
@endsection
