@extends('layouts.admin')

@section('title', 'Clientes - SERVIMETAL')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>RUC/DNI</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id_cliente }}</td>
                        <td>{{ $cliente->nombre_razon_social }}</td>
                        <td>{{ $cliente->ruc_dni }}</td>
                        <td>{{ $cliente->telefono ?? '-' }}</td>
                        <td>{{ $cliente->correo ?? '-' }}</td>
                        <td>
                            <a href="{{ route('clientes.show', $cliente->id_cliente) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" class="d-inline" data-confirm="¿Está seguro?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox"></i> No hay clientes registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
