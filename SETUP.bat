@echo off
REM SERVIMETAL Project Setup Script for Windows

setlocal enabledelayedexpansion

cls
echo.
echo ==================================================
echo SERVIMETAL - Sistema de Gestión de Inventarios
echo ==================================================
echo.

echo.
echo Step 1: Checking PHP installation...
where php >nul 2>nul
if %errorlevel% equ 0 (
    echo [OK] PHP is installed
    php -v | findstr /B "PHP"
) else (
    echo [ERROR] PHP is not found in PATH
    echo Please add PHP to your system PATH
    exit /b 1
)

echo.
echo Step 2: Checking Composer installation...
where composer >nul 2>nul
if %errorlevel% equ 0 (
    echo [OK] Composer is installed
) else (
    echo [ERROR] Composer is not found in PATH
    echo Please install Composer from https://getcomposer.org
    exit /b 1
)

echo.
echo Step 3: Checking MySQL installation...
where mysql >nul 2>nul
if %errorlevel% equ 0 (
    echo [OK] MySQL is installed
) else (
    echo [WARNING] MySQL is not found in PATH
)

echo.
echo ==================================================
echo INSTALLATION STEPS
echo ==================================================
echo.
echo 1. Install PHP dependencies:
echo    composer install
echo.
echo 2. Create environment file:
echo    copy .env.example .env
echo.
echo 3. Generate application key:
echo    php artisan key:generate
echo.
echo 4. Update .env database settings:
echo    DB_DATABASE=servimetal
echo    DB_USERNAME=root
echo    DB_PASSWORD=
echo.
echo 5. Run database migrations:
echo    php artisan migrate:fresh
echo.
echo 6. Start development server:
echo    php artisan serve
echo.
echo 7. Open browser and navigate to:
echo    http://localhost:8000
echo.
echo ==================================================
echo AVAILABLE MODULES
echo ==================================================
echo.
echo [OK] Usuarios (Roles: ADMINISTRADOR, TECNICO)
echo [OK] Clientes (RUC/DNI unique)
echo [OK] Categorías de Materiales
echo [OK] Materiales (Stock ^& Precios)
echo [OK] Servicios (Catálogo)
echo [OK] Solicitudes de Servicio (4 estados)
echo [OK] Movimientos de Inventario (ENTRADA/SALIDA)
echo.
echo ==================================================
echo QUICK COMMANDS
echo ==================================================
echo.
echo composer install              - Install dependencies
echo php artisan key:generate       - Generate app key
echo php artisan migrate:fresh      - Run migrations
echo php artisan serve              - Start server
echo php artisan tinker             - Interactive shell
echo php artisan test               - Run tests
echo.
echo ==================================================
echo.

pause
