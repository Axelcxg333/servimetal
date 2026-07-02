@extends('layouts.admin')

@section('title', 'Entradas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Entradas de inventario</h1>
</div>
<div class="breadcrumb-c mb-4">Entradas <span class="mx-1">›</span> <span class="active">Registro de entradas</span></div>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Registrar entrada</h6>
            <form action="{{ route('entradas.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label-c">Material *</label>
                        <div class="d-flex align-items-center gap-2">
                            <select name="id_material" class="form-select-c flex-grow-1" id="materialSelect" required>
                                <option value="">Seleccionar material</option>
                                @foreach($materiales as $m)
                                    <option value="{{ $m->id_material }}" data-stock="{{ $m->stock_actual }}" data-min="{{ $m->stock_minimo }}">{{ $m->nombre_material }}</option>
                                @endforeach
                            </select>
                            <span id="stockBadge" class="d-none" style="padding:.25rem .6rem;border-radius:20px;font-size:.8rem;font-weight:600;white-space:nowrap;">
                                Stock: <span id="stockValue">0</span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Cantidad *</label>
                        <input type="number" step="0.01" min="0.01" name="cantidad" class="form-control-c" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Fecha *</label>
                        <input type="date" name="fecha_movimiento" class="form-control-c" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Usuario responsable *</label>
                        <select name="id_usuario" class="form-select-c" required>
                            <option value="">Seleccionar usuario</option>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->id_usuario }}">{{ $u->nombres }} {{ $u->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Motivo</label>
                        <input type="text" name="motivo" class="form-control-c" placeholder="Ej. Compra a proveedor">
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Observación</label>
                        <textarea name="observacion" class="form-control-c" rows="2"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary">Registrar entrada</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Últimas entradas</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Material</th>
                            <th>Cantidad</th>
                            <th>Usuario</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entradas as $e)
                            <tr>
                                <td>{{ $e->fecha_movimiento?->format('d/m/Y') }}</td>
                                <td>{{ $e->material->nombre_material ?? '-' }}</td>
                                <td><strong>+{{ $e->cantidad }}</strong></td>
                                <td>{{ $e->usuario->nombres ?? '-' }}</td>
                                <td>{{ $e->motivo ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Sin entradas registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2">{{ $entradas->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
(function() {
    const select = document.getElementById('materialSelect');
    const stockBadge = document.getElementById('stockBadge');
    const stockValue = document.getElementById('stockValue');
    if (!select || !stockBadge || !stockValue) return;

    function getStockColor(stock, min) {
        if (stock <= 0) return { bg: '#fee2e2', text: '#991b1b', label: 'Sin stock' };
        if (stock <= min) return { bg: '#fef3c7', text: '#92400e', label: 'Stock bajo' };
        return { bg: '#d1fae5', text: '#065f46', label: 'Disponible' };
    }

    function updateStock() {
        const opt = select.options[select.selectedIndex];
        if (opt && opt.dataset.stock !== undefined) {
            const stock = parseFloat(opt.dataset.stock);
            const min = parseFloat(opt.dataset.min) || 0;
            const color = getStockColor(stock, min);
            stockValue.textContent = stock;
            stockBadge.classList.remove('d-none');
            stockBadge.style.background = color.bg;
            stockBadge.style.color = color.text;
            stockBadge.title = color.label;
        } else {
            stockBadge.classList.add('d-none');
        }
    }

    select.addEventListener('change', updateStock);
    updateStock();
})();
</script>
@endsection
