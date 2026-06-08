@extends('layouts.admin')

@section('title', 'Mi perfil')

@section('content')
<h1 class="page-title">Mi perfil</h1>
<div class="breadcrumb-c mb-4"><span>Cuenta</span> <span class="mx-1">›</span> <span class="active">Mi perfil</span></div>

<div class="row g-3" style="max-width: 960px;">
    <div class="col-md-4">
        <div class="card-c text-center">
            @php
                $ini = strtoupper(mb_substr($user->nombres, 0, 1) . mb_substr($user->apellidos, 0, 1));
            @endphp
            <div style="width:96px;height:96px;border-radius:50%;background:#0d6efd;color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;margin:1rem auto;">
                {{ $ini }}
            </div>
            <h5 class="mb-0">{{ trim($user->nombres . ' ' . $user->apellidos) }}</h5>
            <small class="text-muted">{{ $user->correo }}</small>
            <hr>
            <div class="text-start small">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Rol</span>
                    <span class="{{ $user->rol === 'ADMINISTRADOR' ? 'badge-soft-danger' : 'badge-soft-info' }}">{{ $user->rol }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Estado</span>
                    <span class="{{ $user->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $user->estado }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">ID</span>
                    <span>USR-{{ str_pad($user->id_usuario, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Editar información</h6>
            <form action="{{ route('perfil.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-c">Nombres *</label>
                        <input type="text" name="nombres" class="form-control-c" value="{{ old('nombres', $user->nombres) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Apellidos *</label>
                        <input type="text" name="apellidos" class="form-control-c" value="{{ old('apellidos', $user->apellidos) }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Correo electrónico *</label>
                        <input type="email" name="correo" class="form-control-c" value="{{ old('correo', $user->correo) }}" required>
                    </div>
                </div>

                <hr class="my-3">
                <h6 class="fw-bold mb-2">Cambiar contraseña</h6>
                <small class="text-muted d-block mb-2">Deja los campos en blanco si no deseas cambiarla.</small>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label-c">Contraseña actual</label>
                        <input type="password" name="contrasena_actual" class="form-control-c">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Nueva contraseña</label>
                        <input type="password" name="contrasena_nueva" class="form-control-c" minlength="8">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-c">Confirmar nueva contraseña</label>
                        <input type="password" name="contrasena_nueva_confirmation" class="form-control-c" minlength="8">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn-c-light">Cancelar</button>
                    <button type="submit" class="btn-c-primary"><i class="fas fa-save me-1"></i> Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
