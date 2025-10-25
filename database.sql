-- INASE - Gestor de Semillas
-- SQL Script para crear la base de datos y tablas

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS gestor_semillas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestor_semillas;

-- Tabla de Muestras (Samples)
CREATE TABLE IF NOT EXISTS samples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_muestra VARCHAR(50) NOT NULL UNIQUE COMMENT 'Código auto-generado de la muestra',
    numero_precinto VARCHAR(100) NOT NULL COMMENT 'Número de precinto',
    empresa VARCHAR(255) NOT NULL COMMENT 'Nombre de la empresa',
    especie VARCHAR(255) NOT NULL COMMENT 'Especie de la semilla',
    cantidad_semillas INT NOT NULL COMMENT 'Cantidad de semillas',
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_especie (especie),
    INDEX idx_created (created)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de Resultados (Results)
CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sample_id INT NOT NULL,
    poder_germinativo DECIMAL(5,2) NOT NULL COMMENT 'Poder germinativo en porcentaje',
    pureza DECIMAL(5,2) NOT NULL COMMENT 'Pureza en porcentaje',
    materiales_inertes TEXT COMMENT 'Materiales inertes (opcional)',
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (sample_id) REFERENCES samples(id) ON DELETE CASCADE,
    INDEX idx_sample_id (sample_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO samples (codigo_muestra, numero_precinto, empresa, especie, cantidad_semillas) VALUES
('MUE-2024-0001', 'PREC-001', 'Semillas del Sur SA', 'Trigo', 1000),
('MUE-2024-0002', 'PREC-002', 'Agrícola Norte SRL', 'Maíz', 1500),
('MUE-2024-0003', 'PREC-003', 'Semillas del Sur SA', 'Soja', 2000),
('MUE-2024-0004', 'PREC-004', 'Semillería Central', 'Girasol', 800),
('MUE-2024-0005', 'PREC-005', 'Agrícola Norte SRL', 'Trigo', 1200);

INSERT INTO results (sample_id, poder_germinativo, pureza, materiales_inertes) VALUES
(1, 92.50, 98.00, 'Restos de paja, tierra'),
(2, 88.75, 95.50, 'Pequeñas piedras'),
(3, 95.00, 99.00, NULL),
(4, 90.25, 97.50, 'Restos vegetales'),
(5, 93.00, 98.50, 'Tierra fina');
