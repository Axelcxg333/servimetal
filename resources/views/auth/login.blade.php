<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - SERVIMETAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        i {
            color: #012555;
        }

        .page-content {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;

            background: #f0f4f8 url('../images/login-background.webp') center/cover no-repeat;
            position: relative;
        }

        .page-content::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(240, 244, 248, 0.75);
            z-index: 0;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 430px;
            padding: 0 1rem;
        }

        .login-title {
            text-align: center;
            color: #1f2937;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .login-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            padding: 2.5rem 2rem 2rem;
        }

        .brand-block {
            text-align: center;
            margin-bottom: 1rem;
        }

        .welcome-title {
            text-align: center;
            color: #012555;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .welcome-sub {
            text-align: center;
            color: #6b7280;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .input-group-text {
            background: #fff;
            border-right: 0;
            color: #9ca3af;
        }

        .form-control {
            border-left: 0;
            padding: 0.6rem 0.9rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .input-group:focus-within .form-control,
        .input-group:focus-within .input-group-text {
            border-color: #012555;
        }

        .btn-login {
            background: #013d8b;
            border: none;
            border-radius: 8px;
            padding: 0.7rem;
            font-weight: 600;
            width: 100%;
            color: #fff;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: #012555;
            color: #fff;
        }

        .forgot {
            text-align: center;
            margin-top: 1.25rem;
        }

        .forgot a {
            color: #0d6efd;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #012555;
            color: white;
            padding: 1.5rem 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">

        <div class="page-content">
            <div class="login-wrapper">
                <h1 class="login-title">Inicio de sesión</h1>
                <div class="login-card">
                    <div class="brand-block">
                        <img src="{{ asset('assets/icons/logo2.webp') }}" alt="Logo" class="img-fluid" style="height: 100px; margin-right: 10px;">
                    </div>

                    <h2 class="welcome-title h5">Bienvenido</h2>
                    <p class="welcome-sub">Ingrese sus credenciales para acceder al sistema.</p>

                    <form action="{{ route('login.attempt') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="usuario" name="usuario" class="form-control"
                                placeholder="Usuario" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="contrasena" name="contrasena" class="form-control"
                                placeholder="Contraseña" required>
                            <span class="input-group-text" style="border-left:0; cursor:pointer;" onclick="togglePassword()">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>

                        <button type="submit" class="btn btn-login">Iniciar sesión</button>

                        <div class="forgot">
                            <a href="#">¿Olvidó su contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="">
            <div class="container">
                    <div class="text-center">
                    <p>&copy; 2024 Servimetal A&M S.A.C. - Todos los derechos reservados</p>
                </div>
            </div>
        </footer>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('contrasena');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
