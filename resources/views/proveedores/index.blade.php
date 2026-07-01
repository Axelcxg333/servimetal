@extends('layouts.admin')

@section('title', 'Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de proveedores</h1>
    <button type="button" class="btn-c-primary" data-bs-toggle="collapse" data-bs-target="#formProv">
        <i class="fas fa-plus me-1"></i> Nuevo proveedor
    </button>
</div>
<div class="breadcrumb-c mb-4">Proveedores <span class="mx-1">›</span> <span class="active">Listado</span></div>

<div class="card-c collapse mb-3" id="formProv">
    <h6 class="fw-bold mb-3">Registro de proveedor</h6>
    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label-c">RUC *</label>
                <input type="text" name="ruc" class="form-control-c" required>
            </div>
            <div class="col-md-8">
                <label class="form-label-c">Razón social *</label>
                <input type="text" name="razon_social" class="form-control-c" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Contacto</label>
                <input type="text" name="contacto" class="form-control-c">
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Teléfono</label>
                <input type="text" name="telefono" class="form-control-c">
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Estado *</label>
                <select name="estado" class="form-select-c" required>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Correo</label>
                <input type="email" name="correo" class="form-control-c">
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Dirección</label>
                <input type="text" name="direccion" class="form-control-c">
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <button type="reset" class="btn-c-light">Cancelar</button>
            <button type="submit" class="btn-c-primary">Guardar</button>
        </div>
    </form>
</div>

<div class="card-c">
    <h6 class="fw-bold mb-3">Listado de proveedores</h6>
    <div class="table-responsive">
        <table class="table-c">
            <thead>
                <tr>
                    <th>RUC</th>
                    <th>Razón social</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores as $p)
                    <tr>
                        <td>{{ $p->ruc }}</td>
                        <td>{{ $p->razon_social }}</td>
                        <td>{{ $p->contacto ?? '-' }}</td>
                        <td>{{ $p->telefono ?? '-' }}</td>
                        <td>{{ $p->correo ?? '-' }}</td>
                        <td>
                            <span class="{{ $p->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $p->estado }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('proveedores.destroy', $p->id_proveedor) }}" method="POST" class="d-inline" data-confirm="¿Eliminar proveedor?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 text-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Sin proveedores registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2">{{ $proveedores->links('pagination::bootstrap-4') }}</div>
</div>
@endsection
