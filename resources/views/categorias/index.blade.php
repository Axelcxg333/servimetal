@extends('layouts.admin')

@section('title', 'Categorías de Material')

@section('content')
@php $editing = isset($categoria); @endphp
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Categorías de material</h1>
</div>
<div class="breadcrumb-c mb-4">Mantenimiento <span class="mx-1">›</span> <span class="active">Categorías de material</span></div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Por favor revise los errores en el formulario.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3">
    <div class="col-lg-5">
        @if($editing)
            <div class="card-c">
                <h6 class="fw-bold mb-3">Editar categoría</h6>
                <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-2">
                        <div class="col-12">
                            <label class="form-label-c">Nombre de la categoría *</label>
                            <input type="text" name="nombre_categoria" class="form-control-c" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label-c">Descripción</label>
                            <textarea name="descripcion" class="form-control-c" rows="3">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('categorias.index') }}" class="btn-c-light">Cancelar</a>
                        <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        @else
            <div class="card-c">
                <h6 class="fw-bold mb-3">Registrar categoría</h6>
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-12">
                            <label class="form-label-c">Nombre de la categoría *</label>
                            <input type="text" name="nombre_categoria" class="form-control-c" placeholder="Ej. Aceros" value="{{ old('nombre_categoria') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label-c">Descripción</label>
                            <textarea name="descripcion" class="form-control-c" rows="3" placeholder="Descripción opcional">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="reset" class="btn-c-light">Cancelar</button>
                        <button type="submit" class="btn-c-primary">Guardar</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Listado de categorías</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Materiales</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $c)
                            <tr>
                                <td>{{ $c->nombre_categoria }}</td>
                                <td>{{ Str::limit($c->descripcion, 60) ?? '-' }}</td>
                                <td><strong>{{ $c->materiales_count }}</strong></td>
                                <td>
                                    <a href="{{ route('categorias.edit', $c->id_categoria) }}" class="text-primary me-2" title="Editar"><i class="fas fa-pen"></i></a>
                                    @if($c->materiales_count == 0)
                                        <form action="{{ route('categorias.destroy', $c->id_categoria) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar categoría?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @else
                                        <span class="text-muted" title="Tiene materiales asociados"><i class="fas fa-trash"></i></span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">Sin categorías registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                <div>Mostrando {{ $categorias->firstItem() ?? 0 }} a {{ $categorias->lastItem() ?? 0 }} de {{ $categorias->total() }} categorías</div>
                {{ $categorias->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
