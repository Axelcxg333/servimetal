@extends('layouts.admin')
@section('title', 'Ver Movimiento - SERVIMETAL')
@section('content')
<h1 class="mb-4">Detalle del Movimiento</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Material:</label>
                <p>{{ $movimiento->material->nombre_material }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tipo:</label>
                <p><span class="badge {{ $movimiento->tipo_movimiento === 'ENTRADA' ? 'bg-success' : 'bg-danger' }}">{{ $movimiento->tipo_movimiento }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Cantidad:</label>
                <p>{{ $movimiento->cantidad }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Fecha:</label>
                <p>{{ $movimiento->fecha_movimiento->format('d/m/Y H:i') }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Usuario:</label>
                <p>{{ $movimiento->usuario->nombres }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Motivo:</label>
                <p>{{ $movimiento->motivo ?? '-' }}</p>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Observaciones:</label>
            <p>{{ $movimiento->observacion ?? '-' }}</p>
        </div>
        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
@endsection
