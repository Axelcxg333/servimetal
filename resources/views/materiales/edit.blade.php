@extends('layouts.admin')

@section('title', 'Editar Material - SERVIMETAL')

@section('content')
<h1 class="page-title">Editar Material</h1>
<div class="breadcrumb-c mb-4"><a href="{{ route('materiales.index') }}">Materiales</a> <span class="mx-1">›</span> <span class="active">Editar</span></div>

<div class="card-c">
    <form action="{{ route('materiales.update', $material->id_material) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-2">
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Categoría *</label>
                <select class="form-select-c" name="id_categoria" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id_categoria }}" {{ old('id_categoria', $material->id_categoria) == $cat->id_categoria ? 'selected' : '' }}>{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Nombre del Material *</label>
                <input type="text" class="form-control-c" name="nombre_material" value="{{ old('nombre_material', $material->nombre_material) }}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Unidad de Medida *</label>
                <select class="form-select-c" name="id_unidad" required>
                    <option value="">Seleccionar unidad</option>
                    @foreach($unidades as $u)
                        <option value="{{ $u->id_unidad }}" {{ old('id_unidad', $material->id_unidad) == $u->id_unidad ? 'selected' : '' }}>
                            {{ $u->nombre_unidad }} ({{ $u->abreviatura }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Descripción</label>
                <input type="text" class="form-control-c" name="descripcion" value="{{ old('descripcion', $material->descripcion) }}">
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Stock Actual *</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="stock_actual" value="{{ old('stock_actual', $material->stock_actual) }}" required>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Stock Mínimo *</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="stock_minimo" value="{{ old('stock_minimo', $material->stock_minimo) }}" required>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Precio Unitario *</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="precio_unitario" value="{{ old('precio_unitario', $material->precio_unitario) }}" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Ubicación</label>
                <input type="text" class="form-control-c" name="ubicacion" value="{{ old('ubicacion', $material->ubicacion) }}">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Estado *</label>
                <select class="form-select-c" name="estado" required>
                    <option value="ACTIVO" {{ old('estado', $material->estado) == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado', $material->estado) == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        </div>
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Actualizar</button>
            <a href="{{ route('materiales.index') }}" class="btn-c-light"><i class="fas fa-times me-1"></i> Cancelar</a>
        </div>
    </form>
</div>
@endsection
