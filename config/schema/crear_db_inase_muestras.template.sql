-- Script SQL para crear la Base de Datos para el sistema de muestras del INASE

DROP DATABASE IF EXISTS ${DB_NAME};
CREATE DATABASE ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ${DB_NAME};

-- ==========================
-- Tabla: muestras
-- ==========================
CREATE TABLE muestras (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(10) NOT NULL,
    numero_precinto VARCHAR(100) NOT NULL,
    empresa VARCHAR(100) NOT NULL,
    especie VARCHAR(150) NOT NULL,
    cantidad_semillas INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uk_codigo (codigo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================
-- Tabla: resultados
-- ==========================
CREATE TABLE resultados (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    muestra_id INT UNSIGNED NOT NULL,
    poder_germinativo DECIMAL(5,2) NULL COMMENT 'Porcentaje, por ejemplo: 32.50',
    pureza DECIMAL(5,2) NULL COMMENT 'Porcentaje',
    materiales_inertes TEXT NULL COMMENT 'Texto opcional, por ejemplo: restos de paja, polvo, etc.',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uk_muestra (muestra_id),
    CONSTRAINT fk_resultados_muestras FOREIGN KEY (muestra_id)
        REFERENCES muestras (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ==========================
-- Crear usuario de base de datos como medida de seguridad
-- ==========================
CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'${DB_HOST}' IDENTIFIED BY '${DB_PASSWORD}';
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB_NAME}.* TO '${DB_USERNAME}'@'${DB_HOST}';
FLUSH PRIVILEGES;
