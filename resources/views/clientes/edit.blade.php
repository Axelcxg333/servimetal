@extends('layouts.admin')

@section('title', 'Editar Cliente - SERVIMETAL')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Editar Cliente</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre_razon_social" class="form-label">Razón Social / Nombre *</label>
                <input type="text" class="form-control @error('nombre_razon_social') is-invalid @enderror" 
                       id="nombre_razon_social" name="nombre_razon_social" value="{{ old('nombre_razon_social', $cliente->nombre_razon_social) }}" required>
                @error('nombre_razon_social') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ruc_dni" class="form-label">RUC / DNI *</label>
                    <input type="text" class="form-control @error('ruc_dni') is-invalid @enderror" 
                           id="ruc_dni" name="ruc_dni" value="{{ old('ruc_dni', $cliente->ruc_dni) }}" required>
                    @error('ruc_dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                           id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                       id="correo" name="correo" value="{{ old('correo', $cliente->correo) }}">
                @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control @error('direccion') is-invalid @enderror" 
                       id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar Cliente
            </button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </form>
    </div>
</div>
@endsection
