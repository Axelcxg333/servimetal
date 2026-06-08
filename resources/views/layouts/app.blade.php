<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SERVIMETAL - Sistema de Gestión')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.5rem;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a.active {
            background-color: #007bff;
            border-left: 4px solid #0056b3;
        }
        .main-content {
            padding: 2rem;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
    @yield('css')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="navbar-brand text-white mb-4 ps-3">
                    <i class="fas fa-industry"></i> SERVIMETAL
                </div>
                <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> Clientes
                </a>
                <a href="{{ route('categorias.index') }}" class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i> Categorías
                </a>
                <a href="{{ route('materiales.index') }}" class="nav-link {{ request()->routeIs('materiales.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Materiales
                </a>
                <a href="{{ route('servicios.index') }}" class="nav-link {{ request()->routeIs('servicios.*') ? 'active' : '' }}">
                    <i class="fas fa-wrench"></i> Servicios
                </a>
                <a href="{{ route('solicitudes.index') }}" class="nav-link {{ request()->routeIs('solicitudes.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i> Solicitudes
                </a>
                <a href="{{ route('movimientos.index') }}" class="nav-link {{ request()->routeIs('movimientos.*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i> Movimientos
                </a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Errores encontrados:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
