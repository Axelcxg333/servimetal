# SERVIMETAL - Sistema de Gestión de Inventarios y Servicios

## Descripción

SERVIMETAL es una plataforma web moderna desarrollada con **Laravel y MySQL** para la gestión integral de inventarios, servicios y solicitudes de la empresa SERVIMETAL A&M S.A.C.

## Características Principales

### 📦 Gestión de Inventarios
- **Materiales**: Gestión completa de productos con categorías, stock y precios
- **Movimientos**: Registro de entradas/salidas con trazabilidad completa
- **Alertas de Stock**: Notificaciones cuando el stock cae por debajo del mínimo

### 👥 Gestión de Usuarios
- **Roles**: ADMINISTRADOR y TECNICO con permisos diferenciados
- **Seguridad**: Contraseñas hasheadas con bcrypt
- **Auditoría**: Registro de operaciones por usuario

### 🏢 Gestión de Clientes
- Almacenamiento de información corporativa (RUC/DNI)
- Contactos y direcciones
- Historial de servicios por cliente

### 🔧 Gestión de Servicios
- Catálogo de servicios disponibles
- Precios referenciales
- Estados (ACTIVO/INACTIVO)

### 📋 Solicitudes de Servicio
- Solicitudes con seguimiento de estado
- Estados: PENDIENTE → EN_PROCESO → FINALIZADO/CANCELADO
- Asignación de responsables
- Detalles y observaciones

### 📊 Dashboard
- Métricas de sistema en tiempo real
- Acceso rápido a todos los módulos
- Contador de solicitudes pendientes

## Requisitos del Sistema

- **PHP**: 8.2 o superior
- **MySQL**: 5.7 o superior
- **Node.js**: 16+ (para gestión de assets)
- **Composer**: Gestor de dependencias PHP

## Instalación

### 1. Clonar o descargar el proyecto
```bash
cd servimetal
```

### 2. Instalar dependencias PHP
```bash
composer install
```

### 3. Configurar variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos en `.env`
```
DB_DATABASE=servimetal
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecutar migraciones
```bash
php artisan migrate:fresh
```

### 6. Instalar dependencias Node (opcional, para assets)
```bash
npm install && npm run dev
```

### 7. Iniciar servidor
```bash
php artisan serve
```

Accede a: `http://localhost:8000`

## Estructura del Proyecto

```
servimetal/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # 7 controladores resource (CRUD)
│   │   └── Requests/           # Validaciones de formulario
│   ├── Models/                 # 7 modelos Eloquent
│   └── Providers/
├── bootstrap/
├── config/                     # Configuraciones de app
├── database/
│   ├── migrations/             # 10 migraciones
│   ├── factories/              # Factories para testing
│   └── seeders/                # Seeders
├── resources/
│   ├── views/
│   │   ├── layouts/            # Layout principal con sidebar
│   │   ├── usuarios/           # 4 vistas
│   │   ├── clientes/           # 4 vistas
│   │   ├── categorias/         # 4 vistas
│   │   ├── materiales/         # 4 vistas
│   │   ├── servicios/          # 4 vistas
│   │   ├── solicitudes/        # 4 vistas
│   │   └── movimientos/        # 4 vistas
│   ├── css/
│   └── js/
├── routes/
│   └── web.php                 # Rutas resource
├── tests/                      # Tests
├── composer.json
├── package.json
└── phpunit.xml
```

## Base de Datos

### Tablas

| Tabla | Descripción | Campos Clave |
|-------|-------------|--------------|
| `usuario` | Usuarios del sistema | id_usuario, rol, correo, contrasena |
| `cliente` | Clientes corporativos | id_cliente, ruc_dni (único), nombre_razon_social |
| `categoria_material` | Categorías de inventario | id_categoria, nombre_categoria |
| `material` | Materiales en inventario | id_material, id_categoria, stock_actual, stock_minimo |
| `servicio` | Servicios disponibles | id_servicio, nombre_servicio, precio_referencial |
| `solicitud_servicio` | Solicitudes de servicio | id_solicitud, id_cliente, id_servicio, estado (ENUM) |
| `movimiento_inventario` | Movimientos de stock | id_movimiento, id_material, tipo_movimiento (ENTRADA/SALIDA) |

## Modelos y Relaciones

```
Usuario
  ├── hasMany SolicitudServicio
  └── hasMany MovimientoInventario

Cliente
  └── hasMany SolicitudServicio

Servicio
  └── hasMany SolicitudServicio

CategoriaMaterial
  └── hasMany Material

Material
  ├── belongsTo CategoriaMaterial
  └── hasMany MovimientoInventario

SolicitudServicio
  ├── belongsTo Cliente
  ├── belongsTo Servicio
  └── belongsTo Usuario

MovimientoInventario
  ├── belongsTo Material
  └── belongsTo Usuario
```

## Controladores

Todos los controladores implementan el patrón resource con 7 métodos:

- `index()` - Lista paginada
- `create()` - Formulario de creación
- `store()` - Guardar nuevo registro
- `show()` - Mostrar detalle
- `edit()` - Formulario de edición
- `update()` - Guardar cambios
- `destroy()` - Eliminar

**Validaciones implementadas:**
- Email único (con exclusión en updates)
- RUC/DNI único
- Tipos de datos (decimal, enum, etc)
- Relaciones (exists on foreign keys)

**Transacciones atómicas:**
- Movimientos de inventario usan DB::transaction()
- Auditoría implícita mediante created_at/updated_at

## Vistas y UI

### Layout Principal
- Sidebar de navegación con 7 módulos
- Header con información
- Sistema de alertas (éxito/error/validación)
- Totalmente responsivo con Bootstrap 5.3.0

### Componentes Comunes
- **Tablas**: Paginated, con badges de estado
- **Formularios**: Validación en cliente y servidor
- **Modales**: Confirmación antes de eliminar
- **Iconos**: Font Awesome 6.4.0

## Flujos de Trabajo

### 1. Gestión de Usuarios
1. Crear usuario con rol (ADMINISTRADOR/TECNICO)
2. Asignar contraseña (min 8 caracteres)
3. Activar/desactivar según necesidad

### 2. Gestión de Clientes
1. Registrar nuevo cliente
2. Ingresar RUC/DNI (único)
3. Guardar contactos

### 3. Gestión de Materiales
1. Crear categorías primero
2. Agregar materiales a categorías
3. Definir stock mínimo y precios
4. Monitorear stock disponible

### 4. Gestión de Solicitudes
1. Cliente solicita servicio
2. Técnico recibe y cambia a EN_PROCESO
3. Al terminar: FINALIZADO
4. Si no se puede: CANCELADO

### 5. Movimientos de Inventario
1. ENTRADA: Compra o ajuste positivo
2. SALIDA: Venta o ajuste negativo
3. Sistema actualiza stock automáticamente
4. Historial completo por material

## API y Endpoints

Todos los endpoints son RESTful:

```
GET    /usuarios              → Listar usuarios
GET    /usuarios/create       → Formulario crear
POST   /usuarios              → Guardar nuevo
GET    /usuarios/{id}         → Ver detalle
GET    /usuarios/{id}/edit    → Formulario editar
PUT    /usuarios/{id}         → Guardar cambios
DELETE /usuarios/{id}         → Eliminar

[Mismo patrón para: clientes, categorias, materiales, servicios, solicitudes, movimientos]
```

## Seguridad

- ✅ Contraseñas hasheadas con bcrypt
- ✅ Validación de entrada (Laravel's Form Request)
- ✅ CSRF protection en todos los formularios
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ Autorización implícita (roles diferenciados)

## Testing

```bash
# Ejecutar tests
php artisan test

# Con coverage
php artisan test --coverage

# Test específico
php artisan test tests/Feature/UsuarioControllerTest.php
```

## Seeders

```bash
# Ejecutar seeders
php artisan db:seed

# Con datos específicos
php artisan db:seed --class=UsuarioSeeder
```

## Troubleshooting

### Error: "php artisan not found"
```bash
composer install
```

### Error: "Class not found"
```bash
composer dumpautoload
```

### Error: "SQLSTATE[HY000]: General error"
```bash
php artisan migrate:fresh
```

### Error: "The encrypted PAYLOAD is invalid"
```bash
php artisan key:generate
```

## Versiones

- **Laravel**: 11.x
- **PHP**: 8.2+
- **MySQL**: 5.7+
- **Bootstrap**: 5.3.0
- **Font Awesome**: 6.4.0

## Autor

Desarrollado para SERVIMETAL A&M S.A.C.

## Licencia

Este proyecto es propietario de SERVIMETAL A&M S.A.C.

---

**Última actualización**: 2024
**Estado**: ✅ Completo
**Módulos implementados**: 7/7
**Vistas completadas**: 28/28
