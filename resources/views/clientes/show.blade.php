@extends('layouts.admin')

@section('title', 'Ver Cliente - SERVIMETAL')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Detalle del Cliente</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold">Razón Social:</label>
                <p>{{ $cliente->nombre_razon_social }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">RUC/DNI:</label>
                <p>{{ $cliente->ruc_dni }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Teléfono:</label>
                <p>{{ $cliente->telefono ?? '-' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Correo:</label>
                <p>{{ $cliente->correo ?? '-' }}</p>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Dirección:</label>
            <p>{{ $cliente->direccion ?? '-' }}</p>
        </div>

        <hr>
        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
</div>
@endsection
