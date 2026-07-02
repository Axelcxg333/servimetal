@extends('layouts.admin')

@section('title', 'Solicitudes de servicio')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Solicitudes de servicio</h1>
</div>
<div class="breadcrumb-c mb-4">Solicitudes <span class="mx-1">›</span> <span class="active">Solicitudes de servicio</span></div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Por favor revise los errores en el formulario.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3">
    <!-- Form -->
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Nueva Solicitud de Servicio</h6>
            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-c">N° Solicitud</label>
                        <input type="text" class="form-control-c" value="Automático" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Fecha *</label>
                        <input type="date" name="fecha_solicitud" class="form-control-c" value="{{ old('fecha_solicitud', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label-c">Cliente *</label>
                        <select name="id_cliente" class="form-select-c" required>
                            <option value="">Seleccione cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id_cliente }}" {{ old('id_cliente') == $c->id_cliente ? 'selected' : '' }}>{{ $c->nombre_razon_social }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label-c">Tipo de Servicio *</label>
                        <select name="id_servicio" class="form-select-c" required>
                            <option value="">Seleccione tipo de servicio</option>
                            @foreach($servicios as $s)
                                <option value="{{ $s->id_servicio }}" {{ old('id_servicio') == $s->id_servicio ? 'selected' : '' }}>{{ $s->nombre_servicio }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label-c">Descripción del Servicio *</label>
                        <textarea name="detalle" class="form-control-c" rows="3" placeholder="Describa el servicio requerido" required>{{ old('detalle') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-c">Prioridad *</label>
                        <select name="prioridad" class="form-select-c" required>
                            <option value="ALTA"  {{ old('prioridad') == 'ALTA' ? 'selected' : '' }}>Alta</option>
                            <option value="MEDIA" {{ old('prioridad', 'MEDIA') == 'MEDIA' ? 'selected' : '' }}>Media</option>
                            <option value="BAJA"  {{ old('prioridad') == 'BAJA' ? 'selected' : '' }}>Baja</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Fecha Requerida *</label>
                        <input type="date" name="fecha_requerida" class="form-control-c" value="{{ old('fecha_requerida') }}" required>
                    </div>

                    <input type="hidden" name="estado" value="PENDIENTE">
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="col-lg-7">
        <div class="card-c">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Listado de Solicitudes</h6>
                <button type="button" class="btn-c-primary" disabled>
                    <i class="fas fa-plus me-1"></i> Nueva Solicitud
                </button>
            </div>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr>
                            <th>N° Solicitud</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Registrado por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitudes as $s)
                            @php
                                $est = match($s->estado) {
                                    'EN_PROCESO' => ['En Proceso', 'badge-soft-info'],
                                    'ATENDIDA'   => ['Atendida', 'badge-soft-success'],
                                    'PENDIENTE'  => ['Pendiente', 'badge-soft-warning'],
                                    'FINALIZADO' => ['Finalizado', 'badge-soft-success'],
                                    'CANCELADO'  => ['Cancelado', 'badge-soft-danger'],
                                    default      => [$s->estado, 'badge-soft-info'],
                                };
                                $prio = match($s->prioridad ?? 'MEDIA') {
                                    'ALTA'  => 'Alta',
                                    'MEDIA' => 'Media',
                                    'BAJA'  => 'Baja',
                                    default => $s->prioridad,
                                };
                                $proxEst = match($s->estado) {
                                    'PENDIENTE'  => 'EN_PROCESO',
                                    'EN_PROCESO' => 'FINALIZADO',
                                    default      => null,
                                };
                            @endphp
                            <tr>
                                <td>SOL-{{ str_pad($s->id_solicitud, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ optional($s->fecha_solicitud)->format('d/m/Y') }}</td>
                                <td>{{ $s->cliente->nombre_razon_social ?? '-' }}</td>
                                <td>{{ $s->servicio->nombre_servicio ?? '-' }}</td>
                                <td>{{ $prio }}</td>
                                <td><span class="{{ $est[1] }}">{{ $est[0] }}</span></td>
                                <td class="small text-muted">{{ $s->usuario->nombres ?? '-' }}</td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('solicitudes.show', $s->id_solicitud) }}" class="text-info" title="Ver"><i class="fas fa-eye"></i></a>
                                    @if($proxEst)
                                    <form action="{{ route('solicitudes.cambiarEstado', $s->id_solicitud) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="estado" value="{{ $proxEst }}">
                                        <button type="submit" class="btn btn-sm btn-link p-0 text-success" title="Avanzar a {{ $proxEst === 'EN_PROCESO' ? 'En Proceso' : 'Finalizado' }}">
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ route('solicitudes.edit', $s->id_solicitud) }}" class="text-primary" title="Editar"><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted py-4">Sin solicitudes registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $solicitudes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
