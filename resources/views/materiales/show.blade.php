@extends('layouts.admin')

@section('title', 'Detalle del Material')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Detalle del Material</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('materiales.edit', $material->id_material) }}" class="btn-c-primary"><i class="fas fa-pen me-1"></i> Editar</a>
        <a href="{{ route('materiales.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>
</div>
<div class="breadcrumb-c mb-4"><a href="{{ route('materiales.index') }}">Materiales</a> <span class="mx-1">›</span> <span class="active">Detalle</span></div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Información General</h6>
            <div class="row g-2">
                <div class="col-6"><div class="form-label-c">Categoría</div><div>{{ $material->categoria->nombre_categoria }}</div></div>
                <div class="col-6"><div class="form-label-c">Nombre</div><div>{{ $material->nombre_material }}</div></div>
                <div class="col-6"><div class="form-label-c">Unidad</div><div>{{ $material->unidad->nombre_unidad ?? '-' }}</div></div>
                <div class="col-6"><div class="form-label-c">Ubicación</div><div>{{ $material->ubicacion ?? '-' }}</div></div>
                <div class="col-6"><div class="form-label-c">Estado</div><div><span class="{{ $material->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $material->estado }}</span></div></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Stock e Inventario</h6>
            <div class="row g-2">
                <div class="col-6"><div class="form-label-c">Stock Actual</div><div><strong>{{ $material->stock_actual }}</strong></div></div>
                <div class="col-6"><div class="form-label-c">Stock Mínimo</div><div>{{ $material->stock_minimo }}</div></div>
                <div class="col-6"><div class="form-label-c">Precio Unitario</div><div>S/ {{ number_format($material->precio_unitario, 2) }}</div></div>
                <div class="col-6"><div class="form-label-c">Valor Total</div><div>S/ {{ number_format($material->stock_actual * $material->precio_unitario, 2) }}</div></div>
            </div>
        </div>
    </div>

    @if($material->movimientos->count() > 0)
    <div class="col-12">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Últimos Movimientos</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr><th>Fecha</th><th>Tipo</th><th>Cantidad</th><th>Usuario</th><th>Motivo</th></tr>
                    </thead>
                    <tbody>
                        @foreach($material->movimientos->take(10) as $mov)
                        <tr>
                            <td>{{ $mov->fecha_movimiento->format('d/m/Y H:i') }}</td>
                            <td><span class="{{ $mov->tipo_movimiento === 'ENTRADA' ? 'badge-soft-success' : 'badge-soft-warning' }}">{{ $mov->tipo_movimiento }}</span></td>
                            <td>{{ $mov->cantidad }}</td>
                            <td>{{ $mov->usuario->nombres }}</td>
                            <td>{{ $mov->motivo ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
