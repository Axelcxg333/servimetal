@extends('layouts.admin')

@section('title', 'Notificaciones')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Notificaciones</h1>
    @if($noLeidasCount > 0)
    <form action="{{ route('notificaciones.todas-leidas') }}" method="POST" style="display:inline;" id="markAllForm">
        @csrf @method('PUT')
        <button type="submit" class="btn-c-primary"><i class="fas fa-check-double me-1"></i> Marcar todas como leídas</button>
    </form>
    @endif
</div>
<div class="breadcrumb-c mb-4">Notificaciones <span class="mx-1">›</span> <span class="active">Todas</span></div>

<div class="card-c mb-4">
    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
        <a href="{{ route('notificaciones.panel') }}" class="btn-sm-c {{ !$tipo ? 'btn-sm-primary' : 'btn-sm-light' }}">Todas</a>
        @foreach($tipos as $t)
            <a href="{{ route('notificaciones.panel', ['tipo' => $t]) }}" class="btn-sm-c {{ $tipo === $t ? 'btn-sm-primary' : 'btn-sm-light' }}">{{ ucfirst(str_replace('_', ' ', $t)) }}</a>
        @endforeach
    </div>

    @forelse($notificaciones as $notif)
    <div class="d-flex align-items-start border-bottom py-3 px-2 {{ !$notif->leida ? 'bg-light' : '' }}">
        <div class="me-3 mt-1">
            @if($notif->tipo === 'stock_bajo')
                <i class="fas fa-exclamation-triangle text-warning"></i>
            @elseif($notif->tipo === 'nueva_solicitud')
                <i class="fas fa-clipboard-list text-info"></i>
            @elseif($notif->tipo === 'entrada_registrada')
                <i class="fas fa-arrow-down text-success"></i>
            @else
                <i class="fas fa-bell text-primary"></i>
            @endif
        </div>
        <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
                <strong>{{ $notif->titulo }}</strong>
                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1 text-muted small">{{ $notif->mensaje }}</p>
            <small class="text-muted">{{ $notif->created_at->format('d/m/Y H:i') }}</small>
        </div>
        <div class="ms-3 d-flex gap-1">
            @if(!$notif->leida)
            <form action="{{ route('notificaciones.marcarLeida', $notif->id_notificacion) }}" method="POST">
                @csrf @method('PUT')
                <button class="btn btn-sm btn-link text-success p-0" title="Marcar como leída"><i class="fas fa-check"></i></button>
            </form>
            @endif
            <form action="{{ route('notificaciones.eliminar', $notif->id_notificacion) }}" method="POST" data-confirm="¿Eliminar esta notificación?">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-link text-danger p-0" title="Eliminar"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center text-muted py-5">
        <i class="fas fa-bell fa-3x mb-3 d-block"></i>
        No hay notificaciones
    </div>
    @endforelse

    <div class="mt-3">
        {{ $notificaciones->links() }}
    </div>
</div>

<style>
.btn-sm-c {
    display: inline-block; padding: .3rem .8rem; border-radius: 20px;
    font-size: .8rem; text-decoration: none; font-weight: 500;
}
.btn-sm-primary { background: #0d6efd; color: #fff; }
.btn-sm-light { background: #f3f4f6; color: #1f2937; border: 1px solid #d1d5db; }
.btn-sm-light:hover { background: #e5e7eb; }
</style>
@endsection
