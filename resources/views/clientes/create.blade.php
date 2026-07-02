@extends('layouts.admin')
@section('title', 'Nuevo Cliente')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Nuevo cliente</h1>
    <a href="{{ route('clientes.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
</div>
<div class="breadcrumb-c mb-4"><a href="{{ route('clientes.index') }}">Clientes</a> <span class="mx-1">›</span> <span class="active">Nuevo</span></div>

<div class="card-c">
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="row g-2">
            <div class="col-md-8">
                <label class="form-label-c">Razón Social / Nombre *</label>
                <input type="text" name="nombre_razon_social" class="form-control-c" value="{{ old('nombre_razon_social') }}" required>
                @error('nombre_razon_social') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-c">RUC / DNI *</label>
                <input type="text" name="ruc_dni" class="form-control-c" value="{{ old('ruc_dni') }}" required>
                @error('ruc_dni') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Teléfono</label>
                <input type="text" name="telefono" class="form-control-c" value="{{ old('telefono') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Correo</label>
                <input type="email" name="correo" class="form-control-c" value="{{ old('correo') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label-c">Dirección</label>
                <input type="text" name="direccion" class="form-control-c" value="{{ old('direccion') }}">
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('clientes.index') }}" class="btn-c-light">Cancelar</a>
            <button type="submit" class="btn-c-primary">Guardar cliente</button>
        </div>
    </form>
</div>
@endsection
