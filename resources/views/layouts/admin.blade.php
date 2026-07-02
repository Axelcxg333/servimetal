<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SERVIMETAL - Sistema de Gestión')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #0d2a52;
            --color-secondary: #0d6efd;
            --color-accent: #2563eb;
            --color-sidebar: #0a2244;
            --sidebar-w: 230px;
        }

        * { box-sizing: border-box; }

        body {
            background: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
            margin: 0;
        }

        .main-wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--color-sidebar);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            color: #fff;
            overflow-y: auto;
            z-index: 1000;
            transition: transform .28s ease, box-shadow .28s ease;
        }
        .sidebar .brand {
            padding: 1.4rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar .brand i {
            font-size: 1.8rem;
            color: #fff;
            margin-right: .35rem;
        }
        .sidebar .brand h5 {
            display: inline-block;
            font-size: 1.05rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
            vertical-align: middle;
        }
        .sidebar .brand p {
            color: rgba(255,255,255,0.55);
            font-size: 0.7rem;
            letter-spacing: 3px;
            margin: .1rem 0 0;
        }

        .sidebar-nav { list-style: none; padding: .5rem 0; margin: 0; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .8rem 1.2rem;
            color: rgba(255,255,255,0.78);
            text-decoration: none;
            font-size: .9rem;
            border-left: 3px solid transparent;
            transition: background .15s;
        }
        .sidebar-nav a:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .sidebar-nav a.active {
            background: rgba(13,110,253,0.15);
            color: #fff;
            border-left-color: #0d6efd;
        }
        .sidebar-nav i { width: 18px; text-align: center; }

        /* Submenú */
        .sidebar-submenu .submenu-toggle { display: flex; align-items: center; cursor: pointer; }
        .sidebar-submenu .submenu-arrow { transition: transform .2s; }
        .sidebar-submenu.open .submenu-arrow { transform: rotate(180deg); }
        .submenu-list { list-style: none; padding: 0; margin: 0; }
        .submenu-list a {
            display: flex; align-items: center; gap: .8rem;
            padding: .6rem 1.2rem .6rem 2.8rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none; font-size: .85rem;
            border-left: 3px solid transparent;
            transition: background .15s;
        }
        .submenu-list a:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .submenu-list a.active { background: rgba(13,110,253,0.12); color: #fff; border-left-color: #0d6efd; }

        /* Main */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            background: #fff;
            padding: .8rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar .left { display: flex; align-items: center; gap: 1rem; }
        .topbar .btn-toggle { background: transparent; border: 0; color: #6b7280; }
        .topbar .right { display: flex; align-items: center; gap: 1.25rem; }
        .topbar .icon-btn {
            background: transparent; border: 0; color: #6b7280; font-size: 1.05rem;
            position: relative;
        }
        .topbar .icon-btn .dot {
            position: absolute; top: -2px; right: -2px;
            background: #ef4444; color: #fff; font-size: .6rem;
            border-radius: 50%; padding: 1px 5px;
        }
        .user-chip { display: flex; align-items: center; gap: .5rem; cursor: pointer; }
        .user-chip .avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #0d6efd; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 700;
        }

        .content { padding: 1.5rem; }

        .page-title { font-size: 1.4rem; font-weight: 700; color: #1f2937; margin: 0; }
        .breadcrumb-c { font-size: .85rem; color: #6b7280; }
        .breadcrumb-c a { color: #6b7280; text-decoration: none; }
        .breadcrumb-c .active { color: #0d6efd; }

        /* Cards / metrics */
        .card-c {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.1rem 1.25rem;
        }
        .metric-card {
            background: #fff;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            border: 1px solid #e5e7eb;
            display: flex; align-items: center; justify-content: space-between;
        }
        .metric-card .label { color: #6b7280; font-size: .85rem; margin: 0; }
        .metric-card .value { color: #1f2937; font-size: 1.6rem; font-weight: 800; margin: 0; line-height: 1; }
        .metric-card .unit { color: #9ca3af; font-size: .7rem; }
        .metric-icon {
            width: 44px; height: 44px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.1rem;
        }
        .metric-icon.blue { background: #0d6efd; }
        .metric-icon.green { background: #198754; }
        .metric-icon.orange { background: #fd7e14; }
        .metric-icon.red { background: #ef4444; }

        /* Tables */
        .table-c {
            width: 100%;
            font-size: .9rem;
        }
        .table-c thead th {
            color: #1f2937;
            font-weight: 600;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            padding: .7rem .8rem;
            text-align: left;
        }
        .table-c tbody td {
            padding: .7rem .8rem;
            border-bottom: 1px solid #f1f1f4;
            vertical-align: middle;
        }

        .badge-soft-success { background: #d1fae5; color: #065f46; padding: .25rem .55rem; border-radius: 6px; font-size: .75rem; font-weight: 600; }
        .badge-soft-warning { background: #fef3c7; color: #92400e; padding: .25rem .55rem; border-radius: 6px; font-size: .75rem; font-weight: 600; }
        .badge-soft-danger  { background: #fee2e2; color: #991b1b; padding: .25rem .55rem; border-radius: 6px; font-size: .75rem; font-weight: 600; }
        .badge-soft-info    { background: #dbeafe; color: #1e3a8a; padding: .25rem .55rem; border-radius: 6px; font-size: .75rem; font-weight: 600; }

        .btn-c-primary {
            background: #0d6efd; color: #fff; border: 1px solid #0d6efd;
            border-radius: 6px; padding: .4rem 1rem; font-size: .85rem; font-weight: 600;
        }
        .btn-c-primary:hover { background: #0b5ed7; color: #fff; }
        .btn-c-light {
            background: #fff; color: #1f2937; border: 1px solid #d1d5db;
            border-radius: 6px; padding: .4rem 1rem; font-size: .85rem; font-weight: 600;
        }
        .btn-c-light:hover { background: #f3f4f6; }

        .form-control-c, .form-select-c {
            border: 1px solid #d1d5db; border-radius: 6px; padding: .5rem .7rem;
            font-size: .9rem; width: 100%;
        }
        .form-control-c:focus, .form-select-c:focus {
            outline: none; border-color: #0d6efd; box-shadow: 0 0 0 2px rgba(13,110,253,0.15);
        }
        .form-label-c {
            color: #0d6efd; font-weight: 600; font-size: .8rem; margin-bottom: .2rem;
        }

        /* Sidebar collapse on desktop only */
        @media (min-width: 769px) {
            body.sidebar-collapsed .sidebar { transform: translateX(-100%); }
            body.sidebar-collapsed .main-content { margin-left: 0; }
        }

        /* Mobile: sidebar hidden by default, shown with .open */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        .sidebar-backdrop {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            opacity: 0;
            transition: opacity .2s ease;
        }
        .sidebar-backdrop.show { display: block; opacity: 1; }

        .modal-content { border-radius: 12px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15); }
    </style>
    @yield('css')
</head>
<body>
    <div class="main-wrapper">
        <!-- Backdrop (móvil) -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <i class="fas fa-cog"></i>
                <h5>SERVIMETAL</h5>
                <p>A &amp; M S.A.C.</p>
            </div>

            <ul class="sidebar-nav">
                <li>
                @if(tieneAcceso('dashboard'))
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>
                @endif
                @if(tieneAcceso('materiales'))
                <li>
                    <a href="{{ route('materiales.index') }}" class="{{ request()->routeIs('materiales.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i> Materiales
                    </a>
                </li>
                @endif
                @if(tieneAcceso('entradas'))
                <li>
                    <a href="{{ route('entradas.index') }}" class="{{ request()->routeIs('entradas.*') ? 'active' : '' }}">
                        <i class="fas fa-sign-in-alt"></i> Entradas
                    </a>
                </li>
                @endif
                @if(tieneAcceso('salidas'))
                <li>
                    <a href="{{ route('salidas.index') }}" class="{{ request()->routeIs('salidas.*') ? 'active' : '' }}">
                        <i class="fas fa-sign-out-alt"></i> Salidas
                    </a>
                </li>
                @endif
                @if(tieneAcceso('solicitudes'))
                <li>
                    <a href="{{ route('solicitudes.index') }}" class="{{ request()->routeIs('solicitudes.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Solicitudes
                    </a>
                </li>
                @endif
                @if(tieneAcceso('proveedores'))
                <li>
                    <a href="{{ route('proveedores.index') }}" class="{{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i> Proveedores
                    </a>
                </li>
                @endif
                @if(tieneAcceso('reportes'))
                <li>
                    <a href="{{ route('reportes.index') }}" class="{{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i> Reportes
                    </a>
                </li>
                @endif
                @if(tieneAcceso('notificaciones'))
                <li>
                    <a href="{{ route('notificaciones.panel') }}" class="{{ request()->routeIs('notificaciones.panel') ? 'active' : '' }}">
                        <i class="fas fa-bell"></i> Notificaciones
                    </a>
                </li>
                @endif

                <!-- Mantenimiento (desplegable) -->
                @php
                    $maintRoute = request()->routeIs('categorias.*') || request()->routeIs('unidades.*') || request()->routeIs('roles.*') || request()->routeIs('permisos.*') || request()->routeIs('servicios.*');
                @endphp
                @if(tieneAcceso('categorias') || tieneAcceso('unidades') || tieneAcceso('roles') || tieneAcceso('servicios'))
                <li class="sidebar-submenu">
                    <a href="#" class="submenu-toggle {{ $maintRoute ? 'active' : '' }}" onclick="toggleMaint(event)">
                        <i class="fas fa-wrench"></i> Mantenimiento
                        <i class="fas fa-chevron-down ms-auto submenu-arrow" id="maintArrow" style="font-size:.7rem;"></i>
                    </a>
                    <ul class="submenu-list" id="maintSubmenu" @if(!$maintRoute) style="display:none;" @endif>
                        @if(tieneAcceso('categorias'))
                        <li>
                            <a href="{{ route('categorias.index') }}" class="{{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                                <i class="fas fa-tags"></i> Categorías
                            </a>
                        </li>
                        @endif
                        @if(tieneAcceso('unidades'))
                        <li>
                            <a href="{{ route('unidades.index') }}" class="{{ request()->routeIs('unidades.*') ? 'active' : '' }}">
                                <i class="fas fa-ruler"></i> Unidades de medida
                            </a>
                        </li>
                        @endif
                        @if(tieneAcceso('servicios'))
                        <li>
                            <a href="{{ route('servicios.index') }}" class="{{ request()->routeIs('servicios.*') ? 'active' : '' }}">
                                <i class="fas fa-concierge-bell"></i> Servicios
                            </a>
                        </li>
                        @endif
                        @if(tieneAcceso('roles'))
                        <li>
                            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <i class="fas fa-user-tag"></i> Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('permisos.index') }}" class="{{ request()->routeIs('permisos.*') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt"></i> Accesos
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(tieneAcceso('usuarios'))
                <li>
                    <a href="{{ route('usuarios.index') }}" class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i> Usuarios
                    </a>
                </li>
                @endif
                @if(tieneAcceso('clientes'))
                <li>
                    <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i> Clientes
                    </a>
                </li>
                @endif
                @if(tieneAcceso('configuracion'))
                <li>
                    <a href="{{ route('configuracion.index') }}" class="{{ request()->routeIs('configuracion.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> Configuración
                    </a>
                </li>
                @endif
            </ul>
        </aside>

        <!-- Main -->
        <div class="main-content">
            <header class="topbar">
                <div class="left">
                    <button class="btn-toggle" id="sidebarToggle" title="Mostrar/ocultar menú">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="right">
                    <div class="dropdown">
                        <button class="icon-btn notification-toggle" title="Notificaciones" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="dot" id="notificationBadge" style="display: none;"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end notification-dropdown" style="width: 360px; max-height: 400px; overflow-y: auto;">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Notificaciones</h6>
                                <button class="btn btn-sm btn-link p-0" id="markAllReadBtn" style="display: none;">Marcar todas como leídas</button>
                            </div>
                            <div id="notificationList" class="notification-list">
                                <div class="text-center text-muted py-4">Cargando...</div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-center text-primary" href="{{ route('notificaciones.panel') }}" id="viewAllNotifications">Ver todas</a>
                        </div>
                    </div>
                    @php
                        $sessionUser  = null;
                        if (Session::has('usuario_id')) {
                            $sessionUser = \App\Models\Usuario::with('rol')->find(Session::get('usuario_id'));
                        }
                        $displayName  = $sessionUser ? trim($sessionUser->nombres . ' ' . $sessionUser->apellidos) : 'Invitado';
                        $initials     = $sessionUser
                            ? strtoupper(mb_substr($sessionUser->nombres, 0, 1) . mb_substr($sessionUser->apellidos, 0, 1))
                            : '?';
                        $userRole     = $sessionUser->rol->nombre_rol ?? '';
                        $userRoleColor = $sessionUser->rol->color ?? '#6c757d';
                    @endphp
                    <div class="dropdown">
                        <div class="user-chip dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="avatar">{{ $initials }}</div>
                            <span class="small">{{ $displayName }}</span>
                            <i class="fas fa-chevron-down small text-muted"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">{{ $displayName }}<br><small class="text-muted"><span style="background:{{ $userRoleColor }};color:#fff;padding:.1rem .5rem;border-radius:20px;font-size:.75rem">{{ $userRole }}</span></small></h6></li>
                            <li><a class="dropdown-item" href="{{ route('perfil.index') }}"><i class="fas fa-user me-2"></i>Mi perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('configuracion.index') }}"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const sidebar    = document.getElementById('sidebar');
            const backdrop   = document.getElementById('sidebarBackdrop');
            const toggleBtn  = document.getElementById('sidebarToggle');
            const mqMobile   = window.matchMedia('(max-width: 768px)');

            function applyMode() {
                if (mqMobile.matches) {
                    document.body.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('open');
                    backdrop.classList.remove('show');
                } else {
                    document.body.classList.toggle(
                        'sidebar-collapsed',
                        localStorage.getItem('sb-collapsed') === '1'
                    );
                }
            }

            function closeMobile() {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            }

            // Estado inicial y al cambiar el tamaño de ventana
            applyMode();
            window.addEventListener('resize', applyMode);

            toggleBtn.addEventListener('click', function () {
                if (mqMobile.matches) {
                    sidebar.classList.toggle('open');
                    backdrop.classList.toggle('show');
                } else {
                    const collapsed = document.body.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sb-collapsed', collapsed ? '1' : '0');
                }
            });

            backdrop.addEventListener('click', closeMobile);

            sidebar.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    if (mqMobile.matches) closeMobile();
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && mqMobile.matches) closeMobile();
            });
        })();

        function toggleMaint(e) {
            if (e) e.preventDefault();
            const sub = document.getElementById('maintSubmenu');
            if (!sub) return;
            const li  = sub.closest('.sidebar-submenu');
            const isHidden = sub.style.display === 'none' || window.getComputedStyle(sub).display === 'none';
            if (isHidden) {
                sub.style.display = 'block';
                li?.classList.add('open');
            } else {
                sub.style.display = 'none';
                li?.classList.remove('open');
            }
        }

        // ===== NOTIFICACIONES =====
        const notificationToggle = document.querySelector('.notification-toggle');
        const notificationList = document.getElementById('notificationList');
        const notificationBadge = document.getElementById('notificationBadge');
        const markAllReadBtn = document.getElementById('markAllReadBtn');

        let notificationInterval;

        function fetchNotifications() {
            fetch('{{ route('notificaciones.index') }}?solo_no_leidas=true')
                .then(response => response.json())
                .then(data => {
                    updateNotificationUI(data);
                    if (data.no_leidas_count > 0) {
                        notificationBadge.textContent = data.no_leidas_count;
                        notificationBadge.style.display = 'inline-block';
                        markAllReadBtn.style.display = 'inline';
                    } else {
                        notificationBadge.style.display = 'none';
                        markAllReadBtn.style.display = 'none';
                    }
                })
                .catch(() => {
                    notificationList.innerHTML = '<div class="text-center text-muted py-4">Error al cargar notificaciones</div>';
                });
        }

        function updateNotificationUI(data) {
            if (data.notificaciones.length === 0) {
                notificationList.innerHTML = '<div class="text-center text-muted py-4">No hay notificaciones</div>';
                return;
            }

            notificationList.innerHTML = '';
            data.notificaciones.forEach(notif => {
                const item = document.createElement('a');
                item.className = 'dropdown-item ' + (notif.leida ? 'text-muted' : 'fw-bold');
                item.href = '#';

                const iconClass = notif.tipo === 'stock_bajo' ? 'text-warning' :
                                 notif.tipo === 'nueva_solicitud' ? 'text-info' :
                                 notif.tipo === 'entrada_registrada' ? 'text-success' : 'text-primary';

                item.innerHTML = `
                    <div class="d-flex align-items-start">
                        <i class="fas fa-circle ${iconClass} me-2 mt-1" style="font-size: 0.6rem;"></i>
                        <div class="flex-grow-1">
                            <div class="small ${notif.leida ? 'text-muted' : ''}">${notif.titulo}</div>
                            <div class="small text-muted">${notif.mensaje}</div>
                            <div class="small text-muted">${notif.created_at ? new Date(notif.created_at).toLocaleString() : ''}</div>
                        </div>
                    </div>
                `;

                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!notif.leida) {
                        fetch(`{{ route('notificaciones.marcarLeida', ['notificacion' => ':id']) }}`.replace(':id', notif.id_notificacion), {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                            }
                        })
                        .then(response => response.json())
                        .then(() => {
                            fetchNotifications();
                        });
                    }
                });

                notificationList.appendChild(item);
            });
        }

        if (notificationToggle) {
            notificationToggle.addEventListener('click', function(e) {
                if (!notificationList.classList.contains('show')) {
                    fetchNotifications();
                }
            });
        }

        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fetch('{{ route('notificaciones.todas-leidas') }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => response.json())
                .then(() => {
                    fetchNotifications();
                })
                .catch(error => {
                    console.error('Error marking all as read:', error);
                });
            });
        }

        if (notificationToggle && !notificationToggle.closest('a')) {
            const dropdown = notificationToggle.closest('.dropdown');
            if (dropdown) {
                dropdown.addEventListener('show.bs.dropdown', function() {
                    fetchNotifications();
                    if (notificationInterval) {
                        clearInterval(notificationInterval);
                    }
                    notificationInterval = setInterval(fetchNotifications, 60000);
                });

                dropdown.addEventListener('hide.bs.dropdown', function() {
                    if (notificationInterval) {
                        clearInterval(notificationInterval);
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchNotifications();
            notificationInterval = setInterval(fetchNotifications, 60000);
        });
</script>

    <!-- Modal global de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirmar</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-3" id="confirmModalMessage">¿Está seguro?</div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-c-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-c-primary" id="confirmModalBtn">Sí, eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var confirmForm = null;
        var modalEl = document.getElementById('confirmModal');
        var modalMsg = document.getElementById('confirmModalMessage');
        var modalBtn = document.getElementById('confirmModalBtn');
        var modal = modalEl ? new bootstrap.Modal(modalEl) : null;

        document.addEventListener('submit', function(e) {
            var form = e.target;
            var msg = form.getAttribute('data-confirm');
            if (msg) {
                e.preventDefault();
                confirmForm = form;
                modalMsg.textContent = msg;
                modal && modal.show();
            }
        });

        if (modalBtn) {
            modalBtn.addEventListener('click', function() {
                if (confirmForm) {
                    modal && modal.hide();
                    confirmForm.removeAttribute('data-confirm');
                    confirmForm.submit();
                    confirmForm = null;
                }
            });
        }

        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function() {
                confirmForm = null;
            });
        }
    })();
    </script>

    @yield('js')
</body>
</html>
