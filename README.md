# INASE - Gestor de Semillas 🌱

Sistema interno para registrar, gestionar y analizar muestras de semillas del laboratorio INASE.

![CakePHP](https://img.shields.io/badge/CakePHP-5.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Requisitos Previos](#-requisitos-previos)
- [Instalación del Ambiente](#-instalación-del-ambiente)
  - [Windows con XAMPP](#windows-con-xampp)
  - [Linux](#linux)
- [Configuración del Proyecto](#-configuración-del-proyecto)
- [Ejecutar la Aplicación](#-ejecutar-la-aplicación)
- [Extensiones Recomendadas](#-extensiones-recomendadas-para-vscode)
- [Solución de Problemas](#-solución-de-problemas)

---

## ✨ Características

### Estado del Desarrollo

- [ ] **Gestión de Muestras**
  - [ ] Registrar nueva muestra
  - [ ] Generación automática de código único
  - [ ] Listar muestras
  - [ ] Ver detalle de muestra
  - [ ] Editar muestra

- [ ] **Gestión de Resultados**
  - [ ] Agregar resultados de análisis
  - [ ] Editar resultados existentes
  - [ ] Validación de porcentajes

- [ ] **Sistema de Reportes**
  - [ ] Tabla resumen con todas las muestras
  - [ ] Filtro por especie
  - [ ] Filtro por rango de fechas

- [ ] **Interfaz de Usuario**
  - [ ] Diseño responsivo con Milligram
  - [ ] Navegación intuitiva
  - [ ] Mensajes de confirmación

---

## 🔧 Requisitos Previos

### Windows
- XAMPP (incluye PHP 8.1+ y MySQL 8.0+)
- Composer
- Git

### Linux
- PHP 8.1+
- MySQL 8.0+
- Apache2
- Composer
- Git

---

## 📦 Instalación del Ambiente

### Windows con XAMPP

#### 1. Instalar XAMPP

Descargar e instalar [XAMPP](https://www.apachefriends.org/es/download.html) en `C:\xampp`

#### 2. Instalar Composer

Descargar e instalar [Composer](https://getcomposer.org/download/) usando el instalador `.exe` oficial. El PATH se configura automáticamente.

#### 3. Configurar Variables de Entorno

Agregar PHP y MySQL al PATH de Windows:

1. Click derecho en **"Mi PC"** → **"Propiedades"**
2. **"Configuración Avanzada del Sistema"** → **"Variables de Entorno"**
3. Editar la variable **"Path"**
4. Agregar:
   ```
   C:\xampp\php
   C:\xampp\mysql\bin
   ```
5. Guardar cambios

#### 4. Configurar MySQL

Abrir **PowerShell como Administrador**:

```powershell
# Acceder a MySQL
mysql -u root

# Establecer contraseña para root
ALTER USER 'root'@'localhost' IDENTIFIED BY 'TU_CONTRASEÑA_SEGURA';
ALTER USER 'root'@'127.0.0.1' IDENTIFIED BY 'TU_CONTRASEÑA_SEGURA';
ALTER USER 'root'@'::1' IDENTIFIED BY 'TU_CONTRASEÑA_SEGURA';

FLUSH PRIVILEGES;
EXIT;
```

#### 5. Configurar phpMyAdmin (Opcional)

Editar `C:\xampp\phpMyAdmin\config.inc.php`:

```php
$cfg['Servers'][$i]['auth_type'] = 'cookie';
$cfg['Servers'][$i]['password'] = 'TU_CONTRASEÑA_SEGURA';
```

#### 6. Iniciar Servicios

Abrir **XAMPP Control Panel** e iniciar:
- ✅ Apache
- ✅ MySQL

---

### Linux

#### 1. Actualizar el Sistema

```bash
sudo apt update && sudo apt upgrade -y
```

#### 2. Instalar Apache, PHP, MySQL y Extensiones

```bash
sudo apt install apache2 php php-cli php-mbstring php-intl php-xml php-mysql php-zip php-curl mysql-server unzip git -y
```

#### 3. Verificar Instalaciones

```bash
php -v
mysql --version
apache2 -v
```

#### 4. Verificar Estado de Servicios

```bash
sudo systemctl status apache2
sudo systemctl status mysql
```

Si no están corriendo, iniciarlos:

```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

#### 5. Configurar MySQL

Ejecutar el asistente de seguridad:

```bash
sudo mysql_secure_installation
```

Esto permite definir la contraseña de root y eliminar configuraciones inseguras.

Acceder a MySQL:

```bash
sudo mysql -u root -p
```

#### 6. Instalar Composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

Verificar instalación:

```bash
composer --version
```

---

## 🚀 Configuración del Proyecto

### 1. Clonar el Repositorio

```bash
git clone https://github.com/TU_USUARIO/INASE-GestorDeSemillas.git
cd INASE-GestorDeSemillas
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar Variables de Entorno

Editar el archivo **`config/.env`**:

```properties
# Host de la base de datos
export DB_HOST="localhost"

# Usuario y contraseña de la aplicación
# El script setup_db va a usar estos datos para crear el usuario
export DB_USERNAME="inase_user"
export DB_PASSWORD=password_seguro_aqui

# Nombre de la base de datos
export DB_NAME=inase_db

# Credenciales de root de MySQL
export MYSQL_ROOT_USERNAME=root
export MYSQL_ROOT_PASSWORD=TU_CONTRASEÑA_SEGURA
```

> **Nota:** Si no configuraste contraseña de root, deja `MYSQL_ROOT_PASSWORD` vacío.

### 4. Crear la Base de Datos

El script automatiza la creación de la base de datos, el usuario y las tablas.

#### Windows (PowerShell)

```powershell
.\scripts\setup_db.ps1
```

#### Linux (Bash)

```bash
chmod +x scripts/setup_db.sh
./scripts/setup_db.sh
```

### 5. Verificar Configuración

El archivo **`config/app_local.php`** debería obtener estos valores usando la función **`env()`**:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'inase_user',
        'password' => 'password_seguro_aqui',
        'database' => 'inase_db',
    ],
],
```

---

## 🎯 Ejecutar la Aplicación

### Iniciar el Servidor

```bash
bin/cake server
```

O con un puerto específico:

```bash
bin/cake server -p 8765
```

### Acceder a la Aplicación

Abrir el navegador en:

```
http://localhost:8765
```

---

## 💡 Extensiones Recomendadas para VSCode

Para mejor experiencia de desarrollo:

- **PHP Intelephense** (DEVSENSE PHP Bundle)
- **CakePHP goto view**
- **PHP Debug**

---

## 🔧 Solución de Problemas

### Error de Conexión a MySQL

- Verificar que MySQL esté corriendo
- Revisar credenciales en `config/.env`
- Confirmar permisos del usuario de base de datos

### Restablecer la Base de Datos

Volver a ejecutar el script de setup:

**Windows:**
```powershell
.\scripts\setup_db.ps1
```

**Linux:**
```bash
./scripts/setup_db.sh
```

### Error "Class not found"

```bash
composer dump-autoload
```

### Los Cambios no se Reflejan

```bash
bin/cake cache clear_all
```

---

## 🛠️ Stack Tecnológico

| Tecnología | Versión |
|------------|---------|
| **CakePHP** | 5.x |
| **PHP** | 8.1+ |
| **MySQL** | 8.0+ |
| **Milligram** | 1.3 |

---

## 📝 Licencia

Proyecto académico para el laboratorio INASE.

---

**Fecha de entrega:** 29 de octubre de 2025