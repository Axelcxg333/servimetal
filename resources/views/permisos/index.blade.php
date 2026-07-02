@extends('layouts.admin')
@section('title', 'Roles y Accesos')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Roles y Accesos</h1>
</div>
<div class="breadcrumb-c mb-4">Configuración <span class="mx-1">›</span> <span class="active">Roles y Accesos</span></div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="row g-3">
    <div class="col-lg-3">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Roles</h6>
            <div class="list-group list-group-flush">
                @foreach($roles as $r)
                    <a href="{{ request()->fullUrlWithQuery(['rol' => $r->id_rol]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ (request('rol') ?: $roles->first()->id_rol) == $r->id_rol ? 'active' : '' }}" style="border:none;border-radius:8px;margin-bottom:4px;{{ (request('rol') ?: $roles->first()->id_rol) == $r->id_rol ? 'background:' . ($r->color ?? '#0d6efd') . ';color:#fff' : '' }}">
                        <span style="width:12px;height:12px;border-radius:50%;background:{{ $r->color ?? '#6c757d' }};flex-shrink:0"></span>
                        {{ $r->nombre_rol }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        @php $selectedRol = $roles->firstWhere('id_rol', request('rol', $roles->first()->id_rol)); @endphp
        @if($selectedRol)
        <div class="card-c">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:{{ $selectedRol->color ?? '#6c757d' }}">{{ $selectedRol->nombre_rol }}</h6>
                <span class="small text-muted">{{ $selectedRol->usuarios()->count() }} usuario(s) con este rol</span>
            </div>
            <form action="{{ route('permisos.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id_rol" value="{{ $selectedRol->id_rol }}">
                @foreach($permisos as $grupo => $items)
                <div class="mb-3">
                    <h6 class="text-muted text-uppercase small mb-2">{{ $grupo }}</h6>
                    <div class="row g-2">
                        @foreach($items as $p)
                        @php $checked = $selectedRol->permisos->contains('id_permiso', $p->id_permiso); @endphp
                        <div class="col-md-4 col-6">
                            <div class="form-check">
                                <input type="checkbox" name="permisos[]" value="{{ $p->id_permiso }}" id="perm_{{ $p->id_permiso }}" class="form-check-input" {{ $checked ? 'checked' : '' }}>
                                <label class="form-check-label small" for="perm_{{ $p->id_permiso }}">{{ $p->nombre }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn-c-primary">Guardar accesos</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
<style>
.list-group-item.active { border-color: transparent !important; }
.form-check-input:checked { background-color: var(--bs-primary, #0d6efd); border-color: var(--bs-primary, #0d6efd); }
</style>
@endsection
