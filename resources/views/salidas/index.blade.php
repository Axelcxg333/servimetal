@extends('layouts.admin')

@section('title', 'Salidas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Salidas de inventario</h1>
</div>
<div class="breadcrumb-c mb-4">Salidas <span class="mx-1">›</span> <span class="active">Registro de salidas</span></div>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Registrar salida</h6>
            <form action="{{ route('salidas.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label-c">Material *</label>
                        <select name="id_material" class="form-select-c" required>
                            <option value="">Seleccionar material</option>
                            @foreach($materiales as $m)
                                <option value="{{ $m->id_material }}">{{ $m->nombre_material }} (Stock: {{ $m->stock_actual }})</option>
                            @endforeach
                        </select>
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
                        <input type="text" name="motivo" class="form-control-c" placeholder="Ej. Consumo en servicio">
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Observación</label>
                        <textarea name="observacion" class="form-control-c" rows="2"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary">Registrar salida</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Últimas salidas</h6>
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
                        @forelse($salidas as $s)
                            <tr>
                                <td>{{ $s->fecha_movimiento?->format('d/m/Y') }}</td>
                                <td>{{ $s->material->nombre_material ?? '-' }}</td>
                                <td><strong class="text-danger">-{{ $s->cantidad }}</strong></td>
                                <td>{{ $s->usuario->nombres ?? '-' }}</td>
                                <td>{{ $s->motivo ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Sin salidas registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-2">{{ $salidas->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
</div>
@endsection
