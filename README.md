# INASE - Gestor de Semillas

Sistema interno para registrar, gestionar y analizar muestras de semillas del Instituto Nacional de Semillas (INASE).

## Características

### Módulo 1: Gestión de Muestras
- Registro de muestras con:
  - `numero_precinto`: Número de precinto identificador
  - `empresa`: Nombre de la empresa remitente
  - `especie`: Especie de la semilla
  - `cantidad_semillas`: Cantidad de semillas en la muestra
  - `codigo_muestra`: Código auto-generado (formato: MUE-YYYY-NNNN)
- Vista de listado con paginación
- Vista de detalle de muestra
- Edición y eliminación de muestras

### Módulo 2: Resultados de Análisis
- Registro de resultados por muestra:
  - `poder_germinativo`: Porcentaje de poder germinativo (0-100%)
  - `pureza`: Porcentaje de pureza (0-100%)
  - `materiales_inertes`: Descripción de materiales inertes (campo opcional)
- Asociación uno-a-muchos con muestras
- CRUD completo de resultados

### Módulo 3: Reportes
- Reporte resumen con estadísticas agregadas:
  - Total de muestras
  - Total de semillas
  - Muestras con resultados
  - Promedio de poder germinativo
  - Promedio de pureza
- Filtros por:
  - Especie
  - Rango de fechas (desde/hasta)
- Vista detallada con todas las muestras y sus resultados

## Requisitos

- PHP 8.1 o superior
- MySQL 5.7 o superior / MariaDB 10.3 o superior
- Composer
- Extensiones PHP:
  - PDO
  - mbstring
  - intl
  - simplexml

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/juop12/INASE-GestorDeSemillas.git
cd INASE-GestorDeSemillas
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar la base de datos

#### Opción A: Usar el script SQL incluido

```bash
# Crear la base de datos y cargar datos de ejemplo
mysql -u root -p < database.sql
```

#### Opción B: Crear manualmente

```sql
CREATE DATABASE gestor_semillas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Luego ejecutar el contenido del archivo `database.sql`.

### 4. Configurar la conexión a la base de datos

Editar el archivo `config/app.php` y actualizar las credenciales de la base de datos:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',      // Host de MySQL
        'port' => '3306',           // Puerto de MySQL
        'username' => 'root',       // Usuario de MySQL
        'password' => '',           // Contraseña de MySQL
        'database' => 'gestor_semillas',
    ],
],
```

O crear un archivo `.env` en la raíz del proyecto:

```env
DB_HOST=localhost
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=gestor_semillas
```

## Ejecución

### Servidor de desarrollo de PHP

```bash
php -S localhost:8000 -t webroot
```

Luego abrir el navegador en: `http://localhost:8000`

### Servidor Apache/Nginx

Configurar el DocumentRoot apuntando a la carpeta `webroot/` del proyecto.

Ejemplo de configuración Apache:

```apache
<VirtualHost *:80>
    ServerName gestor-semillas.local
    DocumentRoot /ruta/al/proyecto/webroot
    
    <Directory /ruta/al/proyecto/webroot>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Estructura del Proyecto

```
INASE-GestorDeSemillas/
├── config/             # Archivos de configuración
│   ├── app.php        # Configuración principal
│   ├── routes.php     # Definición de rutas
│   └── bootstrap.php  # Bootstrap de la aplicación
├── src/               # Código fuente
│   ├── Controller/    # Controladores
│   │   ├── SamplesController.php
│   │   ├── ResultsController.php
│   │   └── ReportsController.php
│   ├── Model/         # Modelos
│   │   ├── Entity/    # Entidades
│   │   └── Table/     # Tablas
│   ├── View/          # Vistas
│   └── Application.php
├── templates/         # Templates de vistas
│   ├── layout/        # Layouts
│   ├── Samples/       # Vistas de muestras
│   ├── Results/       # Vistas de resultados
│   └── Reports/       # Vistas de reportes
├── webroot/           # Archivos públicos
│   ├── css/           # Estilos CSS
│   ├── js/            # JavaScript
│   └── index.php      # Punto de entrada
├── database.sql       # Script SQL de la base de datos
├── composer.json      # Dependencias de Composer
└── README.md          # Este archivo
```

## Uso del Sistema

### Gestión de Muestras

1. **Crear una muestra**: Navegar a "Muestras" > "Nueva Muestra"
   - Ingresar número de precinto, empresa, especie y cantidad
   - El código de muestra se genera automáticamente
   
2. **Ver muestras**: El listado principal muestra todas las muestras con opciones de ver, editar y eliminar

3. **Ver detalle**: Click en "Ver" para ver todos los datos de una muestra y sus resultados asociados

### Gestión de Resultados

1. **Agregar resultado**: Desde el detalle de una muestra, click en "Agregar Resultado"
   - Ingresar poder germinativo (0-100%)
   - Ingresar pureza (0-100%)
   - Opcionalmente, describir materiales inertes

2. **Ver resultados**: Navegar a "Resultados" para ver todos los resultados del sistema

### Reportes

1. **Ver reporte resumen**: Navegar a "Reportes" > "Resumen"
2. **Aplicar filtros**:
   - Seleccionar una especie específica o ver todas
   - Establecer un rango de fechas
   - Click en "Filtrar"
3. **Ver estadísticas**: El reporte muestra estadísticas agregadas y un detalle de todas las muestras

## Tecnologías Utilizadas

- **CakePHP 5.x**: Framework PHP
- **MySQL**: Base de datos relacional
- **PHP 8.3**: Lenguaje de programación
- **HTML5/CSS3**: Interfaz de usuario
- **Bootstrap-inspired CSS**: Estilos responsivos

## Base de Datos

El sistema incluye un script SQL (`database.sql`) que crea:

1. Base de datos `gestor_semillas`
2. Tabla `samples` con:
   - Auto-generación de `codigo_muestra`
   - Índices en `especie` y `created`
3. Tabla `results` con:
   - Relación con `samples`
   - Validaciones de porcentajes (0-100)
4. Datos de ejemplo (5 muestras con resultados)

## Licencia

Este proyecto es un ejercicio de laboratorio para INASE.

## Autor

Desarrollado como parte del ejercicio de laboratorio INASE.
