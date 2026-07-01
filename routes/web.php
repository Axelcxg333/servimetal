<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaMaterialController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SolicitudServicioController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\NotificationApiController;
use Illuminate\Support\Facades\Route;

// ========== RUTAS PÚBLICAS ==========
Route::get('/', fn () => view('corporativo.index'))->name('corporativo.inicio');
Route::get('/empresa/nosotros',   fn () => view('corporativo.nosotros'))->name('corporativo.nosotros');
Route::get('/empresa/servicios',  fn () => view('corporativo.servicios'))->name('corporativo.servicios');
Route::get('/empresa/proyectos',  fn () => view('corporativo.proyectos'))->name('corporativo.proyectos');
Route::get('/empresa/contacto',   fn () => view('corporativo.contacto'))->name('corporativo.contacto');

// ========== LOGIN ==========
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== PERFIL ==========
Route::get('/perfil',        [PerfilController::class, 'index'])->name('perfil.index');
Route::put('/perfil',        [PerfilController::class, 'update'])->name('perfil.update');

// ========== ADMINISTRATIVAS ==========
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('usuarios',    UsuarioController::class);
Route::resource('clientes',    ClienteController::class);
Route::resource('categorias',  CategoriaMaterialController::class)->except(['create', 'show']);
Route::resource('materiales',  MaterialController::class);
Route::resource('servicios',   ServicioController::class);
Route::resource('solicitudes', SolicitudServicioController::class);
Route::resource('movimientos', MovimientoInventarioController::class);

Route::get('/entradas',  [EntradaController::class, 'index'])->name('entradas.index');
Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');

Route::get('/salidas',  [SalidaController::class, 'index'])->name('salidas.index');
Route::post('/salidas', [SalidaController::class, 'store'])->name('salidas.store');

Route::resource('proveedores', ProveedorController::class);
Route::get('/reportes',       [ReporteController::class, 'index'])->name('reportes.index');

Route::get('/configuracion',         [ConfiguracionController::class, 'index'])->name('configuracion.index');
Route::put('/configuracion',         [ConfiguracionController::class, 'update'])->name('configuracion.update');

// ========== UNIDADES DE MEDIDA ==========
Route::resource('unidades', UnidadMedidaController::class)->except(['create', 'show']);

// ========== NOTIFICACIONES ==========
Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
Route::get('/notificaciones/panel', [NotificacionController::class, 'indexView'])->name('notificaciones.panel');
Route::put('/notificaciones/{notificacion}/leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.marcarLeida');
Route::put('/notificaciones/todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('notificaciones.todas-leidas');
Route::delete('/notificaciones/{notificacion}', [NotificacionController::class, 'eliminar'])->name('notificaciones.eliminar');
Route::get('/api/check-low-stock', [NotificationApiController::class, 'checkLowStock'])->name('api.check-low-stock');
