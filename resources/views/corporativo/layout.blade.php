<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SERVIMETAL A&M S.A.C. - Soluciones en Metalmecánica')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #003d7a;
            --color-secondary: #0056b3;
            --color-accent: #007bff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: var(--color-primary);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: color 0.3s;
            margin: 0 0.5rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,61,122,0.7), rgba(0,61,122,0.7)), 
                        url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1200') center/cover;
            color: white;
            padding: 120px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }

        /* Servicios */
        .service-card {
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            background: white;
            border: 1px solid #e9ecef;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .service-card i {
            font-size: 3rem;
            color: var(--color-primary);
            margin-bottom: 1rem;
        }

        /* Footer */
        footer {
            background-color: var(--color-primary);
            color: white;
            padding: 3rem 0 1rem;
        }

        footer a {
            color: #b3d9ff;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
        }

        .footer-link {
            margin: 0.5rem 0;
        }

        /* Botones */
        .btn-primary {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
        }

        .btn-primary:hover {
            background-color: var(--color-secondary);
            border-color: var(--color-secondary);
        }

        /* Section Spacing */
        section {
            padding: 4rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--color-primary);
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Formulario */
        .form-control:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .contact-info {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .contact-info i {
            color: var(--color-primary);
            font-size: 1.5rem;
            margin-right: 1rem;
        }
    </style>
    @yield('css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('corporativo.inicio') }}">
                <i class="fas fa-industry"></i> SERVIMETAL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('corporativo.inicio') ? 'active' : '' }}" href="{{ route('corporativo.inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('corporativo.nosotros') ? 'active' : '' }}" href="{{ route('corporativo.nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('corporativo.servicios') ? 'active' : '' }}" href="{{ route('corporativo.servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('corporativo.proyectos') ? 'active' : '' }}" href="{{ route('corporativo.proyectos') }}">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('corporativo.contacto') ? 'active' : '' }}" href="{{ route('corporativo.contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Acceso</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3">
                    <h5><i class="fas fa-industry"></i> SERVIMETAL</h5>
                    <p class="text-muted">Soluciones integrales en metalmecánica con calidad y compromiso.</p>
                </div>
                <div class="col-md-3">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="footer-link"><a href="{{ route('corporativo.inicio') }}">Inicio</a></li>
                        <li class="footer-link"><a href="{{ route('corporativo.servicios') }}">Servicios</a></li>
                        <li class="footer-link"><a href="{{ route('corporativo.contacto') }}">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Servicios</h5>
                    <ul class="list-unstyled">
                        <li class="footer-link"><a href="#">Fabricación</a></li>
                        <li class="footer-link"><a href="#">Mantenimiento</a></li>
                        <li class="footer-link"><a href="#">Consultoría</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contacto</h5>
                    <p class="text-muted">
                        <i class="fas fa-phone"></i> +51 1 2345678<br>
                        <i class="fas fa-envelope"></i> info@servimetal.com<br>
                        <i class="fas fa-map-marker-alt"></i> Lima, Perú
                    </p>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted">
                <p>&copy; 2024 Servimetal A&M S.A.C. - Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>
