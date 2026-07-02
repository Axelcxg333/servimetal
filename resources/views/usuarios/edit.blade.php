@extends('layouts.admin')
@section('title', 'Editar Usuario')
@section('content')
<h1 class="page-title">Editar Usuario</h1>
<div class="breadcrumb-c mb-4"><a href="{{ route('usuarios.index') }}">Usuarios</a> <span class="mx-1">›</span> <span class="active">Editar</span></div>

<div class="card-c" style="max-width: 760px;">
    <h6 class="fw-bold mb-3">Datos del usuario</h6>
    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-2">
            <div class="col-md-6">
                <label class="form-label-c">Nombres *</label>
                <input type="text" name="nombres" class="form-control-c" value="{{ old('nombres', $usuario->nombres) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Apellidos *</label>
                <input type="text" name="apellidos" class="form-control-c" value="{{ old('apellidos', $usuario->apellidos) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label-c">Correo electrónico *</label>
                <input type="email" name="correo" class="form-control-c" value="{{ old('correo', $usuario->correo) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-c">Contraseña</label>
                <input type="password" name="contrasena" class="form-control-c" minlength="8">
                <small class="text-muted">Dejar en blanco para no cambiar</small>
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Rol *</label>
                <select name="id_rol" class="form-select-c" required>
                    <option value="">Seleccionar</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id_rol }}" {{ old('id_rol', $usuario->id_rol) == $r->id_rol ? 'selected' : '' }}>{{ $r->nombre_rol }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label-c">Estado *</label>
                <select name="estado" class="form-select-c" required>
                    <option value="ACTIVO"   {{ old('estado', $usuario->estado) === 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                    <option value="INACTIVO" {{ old('estado', $usuario->estado) === 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('usuarios.index') }}" class="btn-c-light">Cancelar</a>
            <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
