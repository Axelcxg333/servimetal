@extends('layouts.admin')
@section('title', 'Registrar Movimiento - SERVIMETAL')
@section('content')
<h1 class="mb-4">Registrar Movimiento de Inventario</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('movimientos.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_material" class="form-label">Material *</label>
                    <select class="form-select @error('id_material') is-invalid @enderror" id="id_material" name="id_material" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($materiales as $material)
                            <option value="{{ $material->id_material }}" {{ old('id_material') == $material->id_material ? 'selected' : '' }}>{{ $material->nombre_material }} (Stock: {{ $material->stock_actual }})</option>
                        @endforeach
                    </select>
                    @error('id_material') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo_movimiento" class="form-label">Tipo de Movimiento *</label>
                    <select class="form-select @error('tipo_movimiento') is-invalid @enderror" id="tipo_movimiento" name="tipo_movimiento" required onchange="updateMotiveOptions()">
                        <option value="">-- Seleccionar --</option>
                        <option value="ENTRADA" {{ old('tipo_movimiento') == 'ENTRADA' ? 'selected' : '' }}>ENTRADA</option>
                        <option value="SALIDA" {{ old('tipo_movimiento') == 'SALIDA' ? 'selected' : '' }}>SALIDA</option>
                    </select>
                    @error('tipo_movimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" step="0.01" min="0.01" required>
                    @error('cantidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_usuario" class="form-label">Usuario *</label>
                    <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}" {{ old('id_usuario') == $usuario->id_usuario ? 'selected' : '' }}>{{ $usuario->nombres }}</option>
                        @endforeach
                    </select>
                    @error('id_usuario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" value="{{ old('motivo') }}" placeholder="Compra, Devolución, Ajuste, etc">
                @error('motivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="observacion" class="form-label">Observaciones</label>
                <textarea class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" rows="3">{{ old('observacion') }}</textarea>
                @error('observacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar Movimiento</button>
            <a href="{{ route('movimientos.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
<script>
function updateMotiveOptions() {
    const tipo = document.getElementById('tipo_movimiento').value;
    const motivo = document.getElementById('motivo');
    if (tipo === 'ENTRADA') {
        motivo.placeholder = 'Compra, Ajuste positivo, etc';
    } else if (tipo === 'SALIDA') {
        motivo.placeholder = 'Venta, Ajuste negativo, Uso interno, etc';
    }
}
</script>
@endsection
