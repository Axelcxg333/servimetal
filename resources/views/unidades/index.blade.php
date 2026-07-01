@extends('layouts.admin')

@section('title', 'Unidades de Medida')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Unidades de medida</h1>
</div>
<div class="breadcrumb-c mb-4">Mantenimiento <span class="mx-1">›</span> <span class="active">Unidades de medida</span></div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Por favor revise los errores en el formulario.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Registrar unidad de medida</h6>
            <form action="{{ route('unidades.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label-c">Nombre de la unidad *</label>
                        <input type="text" name="nombre_unidad" class="form-control-c" placeholder="Ej. Kilogramo" value="{{ old('nombre_unidad') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Abreviatura</label>
                        <input type="text" name="abreviatura" class="form-control-c" placeholder="Ej. kg" value="{{ old('abreviatura') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Estado *</label>
                        <select name="estado" class="form-select-c" required>
                            <option value="ACTIVO" {{ old('estado', 'ACTIVO') == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                            <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Descripción</label>
                        <textarea name="descripcion" class="form-control-c" rows="2" placeholder="Descripción opcional">{{ old('descripcion') }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Listado de unidades</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Abreviatura</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unidades as $u)
                            <tr>
                                <td>{{ $u->nombre_unidad }}</td>
                                <td>{{ $u->abreviatura ?? '-' }}</td>
                                <td>
                                    <span class="{{ $u->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $u->estado }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('unidades.edit', $u->id_unidad) }}" class="text-primary me-2" title="Editar"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('unidades.destroy', $u->id_unidad) }}" method="POST" class="d-inline" data-confirm="¿Eliminar unidad de medida?">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Sin unidades registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                <div>Mostrando {{ $unidades->firstItem() ?? 0 }} a {{ $unidades->lastItem() ?? 0 }} de {{ $unidades->total() }} unidades</div>
                {{ $unidades->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
