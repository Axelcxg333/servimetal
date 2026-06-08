@extends('layouts.admin')

@section('title', 'Categorías - SERVIMETAL')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Categorías</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Categoría
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Materiales</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>{{ Str::limit($categoria->descripcion ?? '-', 50) }}</td>
                        <td><span class="badge bg-info">{{ $categoria->materiales->count() }}</span></td>
                        <td>
                            <a href="{{ route('categorias.show', $categoria->id_categoria) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-inbox"></i> No hay categorías registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
