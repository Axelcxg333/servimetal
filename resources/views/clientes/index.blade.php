@extends('layouts.admin')
@section('title', 'Clientes')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn-c-primary"><i class="fas fa-plus me-1"></i> Nuevo cliente</a>
</div>
<div class="breadcrumb-c mb-4">Clientes <span class="mx-1">›</span> <span class="active">Listado</span></div>

<div class="card-c">
    <div class="table-responsive">
        <table class="table-c">
            <thead>
                <tr><th>RUC/DNI</th><th>Razón Social</th><th>Teléfono</th><th>Correo</th><th>Acciones</th></tr>
            </thead>
            <tbody>
                @forelse($clientes as $c)
                <tr>
                    <td>{{ $c->ruc_dni }}</td>
                    <td>{{ $c->nombre_razon_social }}</td>
                    <td>{{ $c->telefono ?? '-' }}</td>
                    <td>{{ $c->correo ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('clientes.show', $c->id_cliente) }}" class="text-info" title="Ver"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('clientes.edit', $c->id_cliente) }}" class="text-primary" title="Editar"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('clientes.destroy', $c->id_cliente) }}" method="POST" class="d-inline" data-confirm="¿Eliminar cliente?">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Sin clientes registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
