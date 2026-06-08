@extends('layouts.admin')
@section('title', 'Editar Movimiento - SERVIMETAL')
@section('content')
<h1 class="mb-4">Editar Movimiento de Inventario</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('movimientos.update', $movimiento->id_movimiento) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_material" class="form-label">Material *</label>
                    <select class="form-select @error('id_material') is-invalid @enderror" id="id_material" name="id_material" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($materiales as $material)
                            <option value="{{ $material->id_material }}" {{ old('id_material', $movimiento->id_material) == $material->id_material ? 'selected' : '' }}>{{ $material->nombre_material }}</option>
                        @endforeach
                    </select>
                    @error('id_material') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo_movimiento" class="form-label">Tipo de Movimiento *</label>
                    <select class="form-select @error('tipo_movimiento') is-invalid @enderror" id="tipo_movimiento" name="tipo_movimiento" required>
                        <option value="ENTRADA" {{ old('tipo_movimiento', $movimiento->tipo_movimiento) == 'ENTRADA' ? 'selected' : '' }}>ENTRADA</option>
                        <option value="SALIDA" {{ old('tipo_movimiento', $movimiento->tipo_movimiento) == 'SALIDA' ? 'selected' : '' }}>SALIDA</option>
                    </select>
                    @error('tipo_movimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', $movimiento->cantidad) }}" step="0.01" min="0.01" required>
                    @error('cantidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_usuario" class="form-label">Usuario *</label>
                    <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}" {{ old('id_usuario', $movimiento->id_usuario) == $usuario->id_usuario ? 'selected' : '' }}>{{ $usuario->nombres }}</option>
                        @endforeach
                    </select>
                    @error('id_usuario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" value="{{ old('motivo', $movimiento->motivo) }}">
                @error('motivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="observacion" class="form-label">Observaciones</label>
                <textarea class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" rows="3">{{ old('observacion', $movimiento->observacion) }}</textarea>
                @error('observacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
            <a href="{{ route('movimientos.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@endsection
