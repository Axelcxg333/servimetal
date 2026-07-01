@extends('layouts.admin')
@section('title', 'Movimientos de Inventario - SERVIMETAL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Movimientos de Inventario</h1>
    <a href="{{ route('movimientos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Movimiento</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-sm mb-0">
            <thead class="table-dark">
                <tr><th>ID</th><th>Material</th><th>Tipo</th><th>Cantidad</th><th>Fecha</th><th>Usuario</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($movimientos as $mov)
                    <tr>
                        <td>{{ $mov->id_movimiento }}</td>
                        <td>{{ $mov->material->nombre_material }}</td>
                        <td><span class="badge {{ $mov->tipo_movimiento === 'ENTRADA' ? 'bg-success' : 'bg-danger' }}">{{ $mov->tipo_movimiento }}</span></td>
                        <td>{{ $mov->cantidad }}</td>
                        <td>{{ $mov->fecha_movimiento->format('d/m/Y H:i') }}</td>
                        <td>{{ $mov->usuario->nombres }}</td>
                        <td>
                            <form action="{{ route('movimientos.destroy', $mov->id_movimiento) }}" method="POST" class="d-inline" data-confirm="¿Está seguro?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4"><i class="fas fa-inbox"></i> Sin movimientos</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($movimientos->hasPages())
        <div class="card-footer">{{ $movimientos->links() }}</div>
    @endif
</div>
@endsection
