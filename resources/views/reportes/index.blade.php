@extends('layouts.admin')

@section('title', 'Reportes')

@section('content')
<h1 class="page-title">Reportes</h1>
<div class="breadcrumb-c mb-4">Reportes <span class="mx-1">›</span> <span class="active">Generación de reportes</span></div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Stock por categoría</h6>
            <table class="table-c">
                <thead>
                    <tr><th>Categoría</th><th>Items</th><th>Total Stock</th></tr>
                </thead>
                <tbody>
                    @foreach($stockPorCategoria as $row)
                        <tr>
                            <td>{{ $row['categoria'] }}</td>
                            <td>{{ $row['items'] }}</td>
                            <td><strong>{{ $row['total'] }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Alertas de stock</h6>
            <table class="table-c">
                <thead>
                    <tr><th>Material</th><th>Stock</th><th>Mínimo</th></tr>
                </thead>
                <tbody>
                    @forelse($alertas as $a)
                        <tr>
                            <td>{{ $a->nombre_material }}</td>
                            <td class="text-danger fw-bold">{{ $a->stock_actual }}</td>
                            <td>{{ $a->stock_minimo }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Sin alertas activas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Movimientos recientes</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr><th>Fecha</th><th>Material</th><th>Tipo</th><th>Cantidad</th><th>Motivo</th></tr>
                    </thead>
                    <tbody>
                        @forelse($movimientos as $m)
                            <tr>
                                <td>{{ $m->fecha_movimiento?->format('d/m/Y H:i') }}</td>
                                <td>{{ $m->material->nombre_material ?? '-' }}</td>
                                <td>
                                    <span class="{{ $m->tipo_movimiento === 'ENTRADA' ? 'badge-soft-success' : 'badge-soft-warning' }}">
                                        {{ $m->tipo_movimiento }}
                                    </span>
                                </td>
                                <td>{{ $m->cantidad }}</td>
                                <td>{{ $m->motivo ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-3">Sin movimientos</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
