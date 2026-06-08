@extends('layouts.admin')
@section('title', 'Editar Servicio - SERVIMETAL')
@section('content')
<h1 class="mb-4">Editar Servicio</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('servicios.update', $servicio->id_servicio) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="nombre_servicio" class="form-label">Nombre del Servicio *</label>
                <input type="text" class="form-control @error('nombre_servicio') is-invalid @enderror" id="nombre_servicio" name="nombre_servicio" value="{{ old('nombre_servicio', $servicio->nombre_servicio) }}" required>
                @error('nombre_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio_referencial" class="form-label">Precio Referencial</label>
                    <input type="number" class="form-control @error('precio_referencial') is-invalid @enderror" id="precio_referencial" name="precio_referencial" value="{{ old('precio_referencial', $servicio->precio_referencial) }}" step="0.01" min="0">
                    @error('precio_referencial') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                        <option value="ACTIVO" {{ old('estado', $servicio->estado) == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
                        <option value="INACTIVO" {{ old('estado', $servicio->estado) == 'INACTIVO' ? 'selected' : '' }}>INACTIVO</option>
                    </select>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
            <a href="{{ route('servicios.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@endsection
