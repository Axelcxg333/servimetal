#!/bin/bash

# SERVIMETAL Project Setup & Verification Script

echo "=================================================="
echo "SERVIMETAL - Sistema de Gestión de Inventarios"
echo "=================================================="
echo ""

# Check PHP version
echo "✓ Verificando PHP..."
php -v | head -n 1

# Check composer
echo ""
echo "✓ Verificando Composer..."
composer --version 2>/dev/null || echo "  ⚠ Composer no encontrado"

# Check MySQL
echo ""
echo "✓ Verificando MySQL..."
mysql --version 2>/dev/null || echo "  ⚠ MySQL no encontrado"

# Count files
echo ""
echo "=================================================="
echo "ESTRUCTURA DEL PROYECTO"
echo "=================================================="
echo ""

# Count migrations
MIGRATIONS=$(find database/migrations -name "*.php" 2>/dev/null | wc -l)
echo "📦 Migraciones: $MIGRATIONS"

# Count models
MODELS=$(find app/Models -name "*.php" 2>/dev/null | wc -l)
echo "🗂️  Modelos: $MODELS"

# Count controllers
CONTROLLERS=$(find app/Http/Controllers -name "*Controller.php" 2>/dev/null | wc -l)
echo "🎮 Controladores: $CONTROLLERS"

# Count views
VIEWS=$(find resources/views -name "*.blade.php" 2>/dev/null | wc -l)
echo "🎨 Vistas Blade: $VIEWS"

echo ""
echo "=================================================="
echo "INSTRUCCIONES DE INSTALACIÓN"
echo "=================================================="
echo ""
echo "1️⃣  Instalar dependencias:"
echo "   composer install"
echo ""
echo "2️⃣  Configurar .env:"
echo "   cp .env.example .env"
echo "   php artisan key:generate"
echo ""
echo "3️⃣  Configurar base de datos en .env:"
echo "   DB_DATABASE=servimetal"
echo "   DB_USERNAME=root"
echo "   DB_PASSWORD="
echo ""
echo "4️⃣  Ejecutar migraciones:"
echo "   php artisan migrate:fresh"
echo ""
echo "5️⃣  Iniciar servidor:"
echo "   php artisan serve"
echo ""
echo "6️⃣  Acceder a:"
echo "   http://localhost:8000"
echo ""
echo "=================================================="
echo "MÓDULOS DISPONIBLES"
echo "=================================================="
echo ""
echo "✅ Usuarios (Roles: ADMINISTRADOR, TECNICO)"
echo "✅ Clientes (RUC/DNI único)"
echo "✅ Categorías de Materiales"
echo "✅ Materiales (Stock + Precios)"
echo "✅ Servicios (Catálogo)"
echo "✅ Solicitudes de Servicio (4 estados)"
echo "✅ Movimientos de Inventario (ENTRADA/SALIDA)"
echo ""
echo "=================================================="
echo "TECNOLOGÍAS UTILIZADAS"
echo "=================================================="
echo ""
echo "• Laravel 11"
echo "• MySQL 5.7+"
echo "• PHP 8.2+"
echo "• Bootstrap 5.3.0"
echo "• Font Awesome 6.4.0"
echo "• Blade Templates"
echo ""
echo "=================================================="

