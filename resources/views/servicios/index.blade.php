@extends('layouts.admin')
@section('title', 'Servicios - SERVIMETAL')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Servicios</h1>
    <a href="{{ route('servicios.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Servicio</a>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id_servicio }}</td>
                        <td>{{ $servicio->nombre_servicio }}</td>
                        <td>{{ $servicio->precio_referencial ? 'S/ ' . number_format($servicio->precio_referencial, 2) : '-' }}</td>
                        <td><span class="badge {{ $servicio->estado === 'ACTIVO' ? 'bg-success' : 'bg-danger' }}">{{ $servicio->estado }}</span></td>
                        <td>
                            <a href="{{ route('servicios.edit', $servicio->id_servicio) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('servicios.destroy', $servicio->id_servicio) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4"><i class="fas fa-inbox"></i> Sin servicios</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
