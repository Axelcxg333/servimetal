@extends('layouts.admin')
@section('title', 'Editar Solicitud')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Editar Solicitud</h1>
    <a href="{{ route('solicitudes.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="breadcrumb-c mb-4">
    <a href="{{ route('solicitudes.index') }}">Solicitudes</a>
    <span class="mx-1">›</span>
    <span class="active">Editar SOL-{{ str_pad($solicitud->id_solicitud, 4, '0', STR_PAD_LEFT) }}</span>
</div>

<div class="card-c">
    <form action="{{ route('solicitudes.update', $solicitud->id_solicitud) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-2">
            <div class="col-md-6">
                <label class="form-label-c">Cliente *</label>
                <select name="id_cliente" class="form-select-c" required>
                    <option value="">Seleccionar</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id_cliente }}" {{ old('id_cliente', $solicitud->id_cliente) == $c->id_cliente ? 'selected' : '' }}>{{ $c->nombre_razon_social }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Tipo de Servicio *</label>
                <select name="id_servicio" class="form-select-c" required>
                    <option value="">Seleccionar</option>
                    @foreach($servicios as $s)
                        <option value="{{ $s->id_servicio }}" {{ old('id_servicio', $solicitud->id_servicio) == $s->id_servicio ? 'selected' : '' }}>{{ $s->nombre_servicio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Prioridad *</label>
                <select name="prioridad" class="form-select-c" required>
                    <option value="ALTA"  {{ old('prioridad', $solicitud->prioridad) == 'ALTA' ? 'selected' : '' }}>Alta</option>
                    <option value="MEDIA" {{ old('prioridad', $solicitud->prioridad) == 'MEDIA' ? 'selected' : '' }}>Media</option>
                    <option value="BAJA"  {{ old('prioridad', $solicitud->prioridad) == 'BAJA' ? 'selected' : '' }}>Baja</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Estado *</label>
                <select name="estado" class="form-select-c" required>
                    @foreach(['PENDIENTE','EN_PROCESO','ATENDIDA','FINALIZADO','CANCELADO'] as $est)
                        <option value="{{ $est }}" {{ old('estado', $solicitud->estado) == $est ? 'selected' : '' }}>{{ match($est) { 'EN_PROCESO' => 'En Proceso', 'ATENDIDA' => 'Atendida', default => ucfirst(strtolower($est)) } }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Fecha de Solicitud *</label>
                <input type="date" name="fecha_solicitud" class="form-control-c" value="{{ old('fecha_solicitud', optional($solicitud->fecha_solicitud)->format('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Fecha Requerida *</label>
                <input type="date" name="fecha_requerida" class="form-control-c" value="{{ old('fecha_requerida', optional($solicitud->fecha_requerida)->format('Y-m-d')) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label-c">Detalle *</label>
                <textarea name="detalle" class="form-control-c" rows="3" required>{{ old('detalle', $solicitud->detalle) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label-c">Observaciones</label>
                <textarea name="observacion" class="form-control-c" rows="2">{{ old('observacion', $solicitud->observacion) }}</textarea>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('solicitudes.index') }}" class="btn-c-light">Cancelar</a>
            <button type="submit" class="btn-c-primary">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
