@extends('layouts.admin')

@section('title', 'Editar Categoría - SERVIMETAL')

@section('content')
<h1 class="mb-4">Editar Categoría</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre de Categoría *</label>
                <input type="text" class="form-control @error('nombre_categoria') is-invalid @enderror" 
                       id="nombre_categoria" name="nombre_categoria" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                @error('nombre_categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                          id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@endsection
