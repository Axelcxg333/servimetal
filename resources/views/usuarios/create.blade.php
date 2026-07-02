@extends('layouts.admin')
@section('title', 'Crear Usuario')
@section('content')
<h1 class="page-title">Crear Nuevo Usuario</h1>
<div class="breadcrumb-c mb-4"><a href="{{ route('usuarios.index') }}">Usuarios</a> <span class="mx-1">›</span> <span class="active">Crear</span></div>

<div class="card-c" style="max-width: 760px;">
    <h6 class="fw-bold mb-3">Datos del usuario</h6>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="row g-2">
            <div class="col-md-6">
                <label class="form-label-c">Nombres *</label>
                <input type="text" name="nombres" class="form-control-c" value="{{ old('nombres') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Apellidos *</label>
                <input type="text" name="apellidos" class="form-control-c" value="{{ old('apellidos') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label-c">Correo electrónico *</label>
                <input type="email" name="correo" class="form-control-c" value="{{ old('correo') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Contraseña *</label>
                <input type="password" name="contrasena" class="form-control-c" minlength="8" required>
                <small class="text-muted">Mínimo 8 caracteres</small>
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Rol *</label>
                <select name="id_rol" class="form-select-c" required>
                    <option value="">Seleccionar</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id_rol }}" {{ old('id_rol') == $r->id_rol ? 'selected' : '' }}>{{ $r->nombre_rol }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Estado *</label>
                <select name="estado" class="form-select-c" required>
                    <option value="ACTIVO"   {{ old('estado', 'ACTIVO') === 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                    <option value="INACTIVO" {{ old('estado') === 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('usuarios.index') }}" class="btn-c-light">Cancelar</a>
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Guardar</button>
        </div>
    </form>
</div>
@endsection
