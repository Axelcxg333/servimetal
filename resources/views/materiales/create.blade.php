@extends('layouts.admin')

@section('title', 'Crear Material - SERVIMETAL')

@section('content')
<h1 class="page-title">Crear Nuevo Material</h1>
<div class="breadcrumb-c mb-4"><a href="{{ route('materiales.index') }}">Materiales</a> <span class="mx-1">›</span> <span class="active">Crear</span></div>

<div class="card-c">
    <form action="{{ route('materiales.store') }}" method="POST">
        @csrf
        <div class="row g-2">
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Categoría *</label>
                <select class="form-select-c @error('id_categoria') is-invalid @enderror" name="id_categoria" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id_categoria }}" {{ old('id_categoria') == $cat->id_categoria ? 'selected' : '' }}>{{ $cat->nombre_categoria }}</option>
                    @endforeach
                </select>
                @error('id_categoria') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Nombre del Material *</label>
                <input type="text" class="form-control-c @error('nombre_material') is-invalid @enderror" name="nombre_material" value="{{ old('nombre_material') }}" required>
                @error('nombre_material') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Unidad de Medida *</label>
                <input type="text" class="form-control-c @error('unidad_medida') is-invalid @enderror" name="unidad_medida" value="{{ old('unidad_medida') }}" required placeholder="kg, lt, und">
                @error('unidad_medida') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Descripción</label>
                <input type="text" class="form-control-c" name="descripcion" value="{{ old('descripcion') }}">
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Stock Actual</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="stock_actual" value="{{ old('stock_actual', 0) }}">
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Stock Mínimo *</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="stock_minimo" value="{{ old('stock_minimo', 0) }}" required>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label-c">Precio Unitario</label>
                <input type="number" step="0.01" min="0" class="form-control-c" name="precio_unitario" value="{{ old('precio_unitario', 0) }}">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Ubicación</label>
                <input type="text" class="form-control-c" name="ubicacion" value="{{ old('ubicacion') }}">
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label-c">Estado *</label>
                <select class="form-select-c" name="estado" required>
                    <option value="ACTIVO" {{ old('estado', 'ACTIVO') == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="INACTIVO" {{ old('estado') == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        </div>
        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Guardar</button>
            <a href="{{ route('materiales.index') }}" class="btn-c-light"><i class="fas fa-times me-1"></i> Cancelar</a>
        </div>
    </form>
</div>
@endsection
