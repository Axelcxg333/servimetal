@extends('layouts.admin')
@section('title', 'Ver Cliente')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Detalle del cliente</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn-c-primary"><i class="fas fa-edit me-1"></i> Editar</a>
        <a href="{{ route('clientes.index') }}" class="btn-c-light"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>
</div>
<div class="breadcrumb-c mb-4"><a href="{{ route('clientes.index') }}">Clientes</a> <span class="mx-1">›</span> <span class="active">{{ $cliente->nombre_razon_social }}</span></div>

<div class="card-c">
    <div class="row g-2">
        <div class="col-md-6">
            <label class="form-label-c text-muted">RUC / DNI</label>
            <p class="fw-semibold fs-6">{{ $cliente->ruc_dni }}</p>
        </div>
        <div class="col-md-6">
            <label class="form-label-c text-muted">Razón Social</label>
            <p class="fw-semibold fs-6">{{ $cliente->nombre_razon_social }}</p>
        </div>
        <div class="col-md-4">
            <label class="form-label-c text-muted">Teléfono</label>
            <p class="fw-semibold">{{ $cliente->telefono ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <label class="form-label-c text-muted">Correo</label>
            <p class="fw-semibold">{{ $cliente->correo ?? '-' }}</p>
        </div>
        <div class="col-md-4">
            <label class="form-label-c text-muted">Dirección</label>
            <p class="fw-semibold">{{ $cliente->direccion ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
