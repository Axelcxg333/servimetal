@extends('layouts.admin')
@section('title', 'Crear Solicitud - SERVIMETAL')
@section('content')
<h1 class="mb-4">Crear Nueva Solicitud de Servicio</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_cliente" class="form-label">Cliente *</label>
                    <select class="form-select @error('id_cliente') is-invalid @enderror" id="id_cliente" name="id_cliente" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}" {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>{{ $cliente->nombre_razon_social }}</option>
                        @endforeach
                    </select>
                    @error('id_cliente') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_servicio" class="form-label">Servicio *</label>
                    <select class="form-select @error('id_servicio') is-invalid @enderror" id="id_servicio" name="id_servicio" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id_servicio }}" {{ old('id_servicio') == $servicio->id_servicio ? 'selected' : '' }}>{{ $servicio->nombre_servicio }}</option>
                        @endforeach
                    </select>
                    @error('id_servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_usuario" class="form-label">Usuario Responsable *</label>
                    <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                        <option value="">-- Seleccionar --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}" {{ old('id_usuario') == $usuario->id_usuario ? 'selected' : '' }}>{{ $usuario->nombres }}</option>
                        @endforeach
                    </select>
                    @error('id_usuario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                        <option value="PENDIENTE" {{ old('estado', 'PENDIENTE') == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                        <option value="EN_PROCESO" {{ old('estado') == 'EN_PROCESO' ? 'selected' : '' }}>EN PROCESO</option>
                        <option value="FINALIZADO" {{ old('estado') == 'FINALIZADO' ? 'selected' : '' }}>FINALIZADO</option>
                        <option value="CANCELADO" {{ old('estado') == 'CANCELADO' ? 'selected' : '' }}>CANCELADO</option>
                    </select>
                    @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="detalle" class="form-label">Detalle de la Solicitud</label>
                <textarea class="form-control @error('detalle') is-invalid @enderror" id="detalle" name="detalle" rows="4">{{ old('detalle') }}</textarea>
                @error('detalle') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="observacion" class="form-label">Observaciones</label>
                <textarea class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" rows="3">{{ old('observacion') }}</textarea>
                @error('observacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>
@endsection
