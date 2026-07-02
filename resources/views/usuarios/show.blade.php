@extends('layouts.admin')
@section('title', 'Detalle de Usuario')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Detalle del Usuario</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn-c-primary"><i class="fas fa-pen me-1"></i> Editar</a>
        <a href="{{ route('usuarios.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>
</div>
<div class="breadcrumb-c mb-4"><a href="{{ route('usuarios.index') }}">Usuarios</a> <span class="mx-1">›</span> <span class="active">Detalle</span></div>

<div class="card-c" style="max-width: 760px;">
    <h6 class="fw-bold mb-3">Información personal</h6>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-label-c">Nombres</div>
            <div>{{ $usuario->nombres }}</div>
        </div>
        <div class="col-md-6">
            <div class="form-label-c">Apellidos</div>
            <div>{{ $usuario->apellidos }}</div>
        </div>
        <div class="col-12">
            <div class="form-label-c">Correo electrónico</div>
            <div>{{ $usuario->correo }}</div>
        </div>
        <div class="col-md-6">
            <div class="form-label-c">Rol</div>
            <span style="background:{{ $usuario->rol->color ?? '#6c757d' }};color:#fff;padding:.2rem .6rem;border-radius:20px;font-size:.8rem">{{ $usuario->rol->nombre_rol ?? '-' }}</span>
        </div>
        <div class="col-md-6">
            <div class="form-label-c">Estado</div>
            <span class="{{ $usuario->estado === 'ACTIVO' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $usuario->estado }}</span>
        </div>
    </div>
</div>
@endsection
