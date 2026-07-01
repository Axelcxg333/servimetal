@extends('layouts.admin')

@section('title', 'Gestión de materiales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de materiales</h1>
    <button type="button" class="btn-c-primary" data-bs-toggle="collapse" data-bs-target="#formMaterial">
        <i class="fas fa-plus me-1"></i> Nuevo material
    </button>
</div>
<div class="breadcrumb-c mb-4">Materiales <span class="mx-1">›</span> <span class="active">Gestión de Materiales</span></div>

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
            <h6 class="fw-bold mb-3">Registro de material</h6>
            <form action="{{ route('materiales.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-c">Código *</label>
                        <input type="text" class="form-control-c" value="SL-MAT-{{ str_pad($siguienteId, 4, '0', STR_PAD_LEFT) }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Nombre del material *</label>
                        <input type="text" name="nombre_material" class="form-control-c" placeholder="Ingrese nombre del material" value="{{ old('nombre_material') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-c">Categoría *</label>
                        <select name="id_categoria" class="form-select-c" required>
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id_categoria }}" {{ old('id_categoria') == $cat->id_categoria ? 'selected' : '' }}>
                                    {{ $cat->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-c">Unidad de medida *</label>
                        <select name="id_unidad" class="form-select-c" required>
                            <option value="">Seleccionar unidad</option>
                            @foreach($unidades as $u)
                                <option value="{{ $u->id_unidad }}" {{ old('id_unidad') == $u->id_unidad ? 'selected' : '' }}>
                                    {{ $u->nombre_unidad }} ({{ $u->abreviatura }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label-c">Descripción</label>
                        <textarea name="descripcion" class="form-control-c" rows="2" placeholder="Ingrese descripción del material">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-c">Stock mínimo *</label>
                        <input type="number" step="0.01" min="0" name="stock_minimo" class="form-control-c" placeholder="Ingrese stock mínimo" value="{{ old('stock_minimo', 0) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-c">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control-c" placeholder="Ingrese ubicación" value="{{ old('ubicacion') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label-c">Estado *</label>
                        <select name="estado" class="form-select-c" required>
                            <option value="ACTIVO" {{ old('estado', 'ACTIVO') == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                            <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Listado de materiales</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Material</th>
                            <th>Categoría</th>
                            <th>Unidad</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materiales as $m)
                            @php
                                if ($m->stock_actual <= 0) {
                                    $estado = 'Crítico';
                                    $cls = 'badge-soft-danger';
                                } elseif ($m->stock_actual <= $m->stock_minimo) {
                                    $estado = 'Por Stock';
                                    $cls = 'badge-soft-warning';
                                } else {
                                    $estado = 'Disponible';
                                    $cls = 'badge-soft-success';
                                }
                            @endphp
                            <tr>
                                <td>MAT-{{ str_pad($m->id_material, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $m->nombre_material }}</td>
                                <td>{{ $m->categoria->nombre_categoria ?? '-' }}</td>
                                <td>{{ $m->unidad->nombre_unidad ?? '-' }}</td>
                                <td><strong>{{ $m->stock_actual }}</strong></td>
                                <td><span class="{{ $cls }}">{{ $estado }}</span></td>
                                <td>
                                    <a href="{{ route('materiales.edit', $m->id_material) }}" class="text-primary me-2" title="Editar"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('materiales.destroy', $m->id_material) }}" method="POST" class="d-inline" data-confirm="¿Eliminar material?">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">Sin materiales registrados</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                <div>Mostrando {{ $materiales->firstItem() ?? 0 }} a {{ $materiales->lastItem() ?? 0 }} de {{ $materiales->total() }} materiales</div>
                {{ $materiales->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
