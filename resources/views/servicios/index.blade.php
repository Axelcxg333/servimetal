@extends('layouts.admin')
@section('title', 'Servicios')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de servicios</h1>
</div>
<div class="breadcrumb-c mb-4">Servicios <span class="mx-1">›</span> <span class="active">Listado</span></div>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">{{ isset($servicio) ? 'Editar servicio' : 'Nuevo servicio' }}</h6>
            <form action="{{ isset($servicio) ? route('servicios.update', ['servicio' => $servicio->id_servicio]) : route('servicios.store') }}" method="POST">
                @csrf
                @if(isset($servicio)) @method('PUT') @endif
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label-c">Nombre *</label>
                        <input type="text" name="nombre_servicio" class="form-control-c" value="{{ old('nombre_servicio', $servicio->nombre_servicio ?? '') }}" required>
                        @error('nombre_servicio') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Descripción</label>
                        <textarea name="descripcion" class="form-control-c" rows="3">{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
                        @error('descripcion') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Precio referencial</label>
                        <input type="number" step="0.01" min="0" name="precio_referencial" class="form-control-c" value="{{ old('precio_referencial', $servicio->precio_referencial ?? '') }}">
                        @error('precio_referencial') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Estado *</label>
                        <select name="estado" class="form-select-c" required>
                            <option value="ACTIVO" {{ old('estado', $servicio->estado ?? 'ACTIVO') == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                            <option value="INACTIVO" {{ old('estado', $servicio->estado ?? '') == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    @if(isset($servicio))
                        <a href="{{ route('servicios.index') }}" class="btn-c-light">Cancelar</a>
                    @endif
                    <button type="submit" class="btn-c-primary">{{ isset($servicio) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Listado de servicios</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead>
                    <tbody>
                        @forelse($servicios as $s)
                        <tr>
                            <td>{{ $s->id_servicio }}</td>
                            <td>{{ $s->nombre_servicio }}</td>
                            <td>{{ $s->precio_referencial ? 'S/ ' . number_format($s->precio_referencial, 2) : '-' }}</td>
                            <td><span class="{{ $s->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $s->estado }}</span></td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('servicios.edit', $s->id_servicio) }}" class="text-primary" title="Editar"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('servicios.destroy', $s->id_servicio) }}" method="POST" class="d-inline" data-confirm="¿Eliminar servicio?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Sin servicios registrados</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
