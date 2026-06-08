@extends('layouts.admin')

@section('title', 'Ver Categoría - SERVIMETAL')

@section('content')
<h1 class="mb-4">Detalle de Categoría</h1>

<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label fw-bold">Nombre:</label>
            <p>{{ $categoria->nombre_categoria }}</p>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Descripción:</label>
            <p>{{ $categoria->descripcion ?? '-' }}</p>
        </div>
        <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>

@if($categoria->materiales->count() > 0)
<h5>Materiales en esta Categoría</h5>
<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoria->materiales as $material)
            <tr>
                <td>{{ $material->nombre_material }}</td>
                <td>{{ $material->stock_actual }}</td>
                <td>${{ $material->precio_unitario }}</td>
                <td><span class="badge {{ $material->estado === 'ACTIVO' ? 'bg-success' : 'bg-danger' }}">{{ $material->estado }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
