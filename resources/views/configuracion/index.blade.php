@extends('layouts.admin')

@section('title', 'Configuración')

@section('content')
<h1 class="page-title">Configuración del sistema</h1>
<div class="breadcrumb-c mb-4">Configuración <span class="mx-1">›</span> <span class="active">General</span></div>

<div class="card-c" style="max-width: 720px;">
    <h6 class="fw-bold mb-3">Datos de la empresa</h6>
    <form action="{{ route('configuracion.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label-c">Nombre de la empresa *</label>
                <input type="text" name="nombre_empresa" class="form-control-c" value="{{ old('nombre_empresa', $cfg->nombre_empresa) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label-c">RUC *</label>
                <input type="text" name="ruc" class="form-control-c" value="{{ old('ruc', $cfg->ruc) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Teléfono</label>
                <input type="text" name="telefono" class="form-control-c" value="{{ old('telefono', $cfg->telefono) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Correo</label>
                <input type="email" name="correo" class="form-control-c" value="{{ old('correo', $cfg->correo) }}">
            </div>
            <div class="col-12">
                <label class="form-label-c">Dirección</label>
                <input type="text" name="direccion" class="form-control-c" value="{{ old('direccion', $cfg->direccion) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Stock mínimo global *</label>
                <input type="number" step="0.01" min="0" name="stock_min_global" class="form-control-c" value="{{ old('stock_min_global', $cfg->stock_min_global) }}" required>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
