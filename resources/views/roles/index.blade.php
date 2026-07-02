@extends('layouts.admin')
@section('title', 'Roles')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="page-title">Gestión de roles</h1>
</div>
<div class="breadcrumb-c mb-4">Roles <span class="mx-1">›</span> <span class="active">Listado</span></div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card-c">
            <h6 class="fw-bold mb-3">{{ isset($rol) ? 'Editar rol' : 'Nuevo rol' }}</h6>
            <form action="{{ isset($rol) ? route('roles.update', ['rol' => $rol->id_rol]) : route('roles.store') }}" method="POST">
                @csrf
                @if(isset($rol)) @method('PUT') @endif
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label-c">Nombre del rol *</label>
                        <input type="text" name="nombre_rol" class="form-control-c" value="{{ old('nombre_rol', $rol->nombre_rol ?? '') }}" required>
                        @error('nombre_rol') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Descripción</label>
                        <input type="text" name="descripcion" class="form-control-c" value="{{ old('descripcion', $rol->descripcion ?? '') }}">
                        @error('descripcion') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-c">Color <small class="text-muted">(opcional)</small></label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" name="color" class="form-control-c color-picker" style="width:60px;height:40px;padding:3px" value="{{ old('color', $rol->color ?? '#6c757d') }}">
                            <span class="color-preview" style="background:{{ old('color', $rol->color ?? '#6c757d') }};color:#fff;padding:.2rem .7rem;border-radius:20px;font-size:.82rem;font-weight:500;transition:background .15s">{{ $rol->nombre_rol ?? 'Vista previa' }}</span>
                            <span class="small text-muted">Elige un color para identificar el rol</span>
                        </div>
                        @error('color') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-3">
                    @if(isset($rol))
                        <a href="{{ route('roles.index') }}" class="btn-c-light">Cancelar</a>
                    @endif
                    <button type="submit" class="btn-c-primary">{{ isset($rol) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card-c">
            <h6 class="fw-bold mb-3">Listado de roles</h6>
            <div class="table-responsive">
                <table class="table-c">
                    <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Usuarios</th><th>Acciones</th></tr></thead>
                    <tbody>
                        @forelse($roles as $r)
                        <tr>
                            <td>ROL-{{ str_pad($r->id_rol, 2, '0', STR_PAD_LEFT) }}</td>
                            <td><span style="background:{{ $r->color ?? '#6c757d' }};color:#fff;padding:.2rem .6rem;border-radius:20px;font-size:.8rem">{{ $r->nombre_rol }}</span></td>
                            <td>{{ $r->descripcion ?? '-' }}</td>
                            <td>{{ $r->usuarios()->count() }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('roles.edit', ['rol' => $r->id_rol]) }}" class="text-primary" title="Editar"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('roles.destroy', ['rol' => $r->id_rol]) }}" method="POST" class="d-inline" data-confirm="¿Eliminar rol?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Sin roles registrados</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                <div>Mostrando {{ $roles->firstItem() ?? 0 }} a {{ $roles->lastItem() ?? 0 }} de {{ $roles->total() }} roles</div>
                {{ $roles->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.querySelector('.color-picker')?.addEventListener('input', function() {
        const preview = this.closest('.d-flex').querySelector('.color-preview');
        if (preview) preview.style.background = this.value;
    });
    document.querySelector('input[name="nombre_rol"]')?.addEventListener('input', function() {
        const preview = document.querySelector('.color-preview');
        if (preview) preview.textContent = this.value || 'Vista previa';
    });
</script>
@endsection
