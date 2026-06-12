@extends('layouts.admin')

@section('title', 'Dashboard de inventario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Dashboard de inventario</h1>
</div>
<div class="breadcrumb-c mb-4">Dashboard</div>

<!-- Métricas -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="metric-card">
            <div>
                <p class="label">Stock Total</p>
                <p class="value">{{ number_format($stockTotal, 0) }}</p>
                <small class="unit">ítems</small>
            </div>
            <div class="metric-icon blue"><i class="fas fa-boxes-stacked"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card">
            <div>
                <p class="label">Entradas</p>
                <p class="value">{{ number_format($entradasCount, 0) }}</p>
                <small class="unit">ítems</small>
            </div>
            <div class="metric-icon green"><i class="fas fa-arrow-down"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card">
            <div>
                <p class="label">Salidas</p>
                <p class="value">{{ number_format($salidasCount, 0) }}</p>
                <small class="unit">ítems</small>
            </div>
            <div class="metric-icon orange"><i class="fas fa-arrow-up"></i></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="metric-card">
            <div>
                <p class="label">Alertas</p>
                <p class="value">{{ number_format($alertasCount, 0) }}</p>
                <small class="unit">ítems</small>
            </div>
            <div class="metric-icon red"><i class="fas fa-exclamation-triangle"></i></div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row g-3 mb-4">
    <div class="col-md-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Stock por Categoría</h6>
            <div style="position:relative; height:280px;">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Movimientos <small class="text-muted fw-normal">(Últimos 6 meses)</small></h6>
            <div style="position:relative; height:280px;">
                <canvas id="movimientosChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Últimos materiales -->
<div class="card-c">
    <h6 class="fw-bold mb-3">Últimos Materiales</h6>
    <div class="table-responsive">
        <table class="table-c">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Material</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Unidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimosMateriales as $m)
                    @php
                        if ($m->stock_actual <= 0) {
                            $estado = 'Crítico';
                            $cls = 'badge-soft-danger';
                        } elseif ($m->stock_actual <= $m->stock_minimo) {
                            $estado = 'Por Stock';
                            $cls = 'badge-soft-warning';
                        } else {
                            $estado = 'Disponible';
                            $cls = 'badge-soft-success';
                        }
                    @endphp
                    <tr>
                        <td>MAT-{{ str_pad($m->id_material, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $m->nombre_material }}</td>
                        <td>{{ $m->categoria->nombre_categoria ?? 'Sin categoría' }}</td>
                        <td><strong>{{ $m->stock_actual }}</strong></td>
                        <td>{{ $m->unidad->nombre_unidad ?? '-' }}</td>
                        <td><span class="{{ $cls }}">{{ $estado }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Sin materiales registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const stockColors = ['#0d6efd', '#fd7e14', '#198754', '#dc3545', '#6f42c1', '#ffc107', '#20c997'];

    new Chart(document.getElementById('stockChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoriesData['labels']) !!},
            datasets: [{
                data: {!! json_encode($categoriesData['data']) !!},
                backgroundColor: stockColors,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '55%',
            plugins: { legend: { position: 'right' } }
        }
    });

    new Chart(document.getElementById('movimientosChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($movementsData['labels']) !!},
            datasets: [
                {
                    label: 'Entradas',
                    data: {!! json_encode($movementsData['entradas']) !!},
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25,135,84,0.1)',
                    borderWidth: 2, fill: true, tension: 0.35,
                    pointBackgroundColor: '#198754', pointRadius: 4
                },
                {
                    label: 'Salidas',
                    data: {!! json_encode($movementsData['salidas']) !!},
                    borderColor: '#fd7e14',
                    backgroundColor: 'rgba(253,126,20,0.1)',
                    borderWidth: 2, fill: true, tension: 0.35,
                    pointBackgroundColor: '#fd7e14', pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
