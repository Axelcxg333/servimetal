@extends('layouts.admin')

@section('title', 'Editar Unidad de Medida')

@section('content')
<h1 class="page-title">Editar Unidad de Medida</h1>
<div class="breadcrumb-c mb-4"><a href="{{ route('unidades.index') }}">Unidades de Medida</a> <span class="mx-1">›</span> <span class="active">Editar</span></div>

<div class="card-c" style="max-width: 600px;">
    <h6 class="fw-bold mb-3">Datos de la unidad</h6>
    <form action="{{ route('unidades.update', $unidad->id_unidad) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-2">
            <div class="col-12">
                <label class="form-label-c">Nombre de la unidad *</label>
                <input type="text" name="nombre_unidad" class="form-control-c" value="{{ old('nombre_unidad', $unidad->nombre_unidad) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Abreviatura</label>
                <input type="text" name="abreviatura" class="form-control-c" value="{{ old('abreviatura', $unidad->abreviatura) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Estado *</label>
                <select name="estado" class="form-select-c" required>
                    <option value="ACTIVO"   {{ old('estado', $unidad->estado) == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                    <option value="INACTIVO" {{ old('estado', $unidad->estado) == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label-c">Descripción</label>
                <textarea name="descripcion" class="form-control-c" rows="3">{{ old('descripcion', $unidad->descripcion) }}</textarea>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('unidades.index') }}" class="btn-c-light">Cancelar</a>
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
