@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn-c-primary">
        <i class="fas fa-plus me-1"></i> Nuevo usuario
    </a>
</div>
<div class="breadcrumb-c mb-4">Usuarios <span class="mx-1">›</span> <span class="active">Listado</span></div>

<div class="card-c">
    <h6 class="fw-bold mb-3">Listado de usuarios</h6>
    <div class="table-responsive">
        <table class="table-c">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                    <tr>
                        <td>USR-{{ str_pad($u->id_usuario, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $u->nombres }}</td>
                        <td>{{ $u->apellidos }}</td>
                        <td>{{ $u->correo }}</td>
                        <td>
                            <span class="{{ $u->rol === 'ADMINISTRADOR' ? 'badge-soft-danger' : 'badge-soft-info' }}">
                                {{ $u->rol }}
                            </span>
                        </td>
                        <td>
                            <span class="{{ $u->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $u->estado }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('usuarios.show', $u->id_usuario) }}" class="text-info me-2" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('usuarios.edit', $u->id_usuario) }}" class="text-primary me-2" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('usuarios.destroy', $u->id_usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar usuario?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Sin usuarios registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
        <div>Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios</div>
        {{ $usuarios->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
