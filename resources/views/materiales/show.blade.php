@extends('layouts.app')

@section('title', 'Ver Material - SERVIMETAL')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h1>Detalle del Material</h1>
    <div>
        <a href="{{ route('materiales.edit', $material->id_material) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
        <a href="{{ route('materiales.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Información General</div>
            <div class="card-body">
                <p><strong>Categoría:</strong> {{ $material->categoria->nombre_categoria }}</p>
                <p><strong>Nombre:</strong> {{ $material->nombre_material }}</p>
                <p><strong>Unidad:</strong> {{ $material->unidad_medida }}</p>
                <p><strong>Ubicación:</strong> {{ $material->ubicacion ?? '-' }}</p>
                <p><strong>Estado:</strong> <span class="badge {{ $material->estado === 'ACTIVO' ? 'bg-success' : 'bg-danger' }}">{{ $material->estado }}</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Stock e Inventario</div>
            <div class="card-body">
                <p><strong>Stock Actual:</strong> <span class="badge bg-info">{{ $material->stock_actual }}</span></p>
                <p><strong>Stock Mínimo:</strong> {{ $material->stock_minimo }}</p>
                <p><strong>Precio Unitario:</strong> S/ {{ number_format($material->precio_unitario, 2) }}</p>
                <p><strong>Valor Total:</strong> S/ {{ number_format($material->stock_actual * $material->precio_unitario, 2) }}</p>
            </div>
        </div>
    </div>
</div>

@if($material->movimientos->count() > 0)
<div class="card">
    <div class="card-header">Últimos Movimientos</div>
    <div class="table-responsive">
        <table class="table table-sm mb-0">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($material->movimientos->take(10) as $mov)
                <tr>
                    <td>{{ $mov->fecha_movimiento->format('d/m/Y H:i') }}</td>
                    <td><span class="badge {{ $mov->tipo_movimiento === 'ENTRADA' ? 'bg-success' : 'bg-danger' }}">{{ $mov->tipo_movimiento }}</span></td>
                    <td>{{ $mov->cantidad }}</td>
                    <td>{{ $mov->usuario->nombres }}</td>
                    <td>{{ $mov->motivo ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
