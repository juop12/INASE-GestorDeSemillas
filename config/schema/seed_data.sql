SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE resultados;
TRUNCATE TABLE muestras;
SET FOREIGN_KEY_CHECKS=1;

-- Luego insertás tus datos
INSERT INTO muestras (codigo, numero_precinto, empresa, especie, cantidad_semillas, created_at, updated_at)
VALUES
('MUE0001', 'A001', 'AgroLab SRL', 'Trigo', 500, NOW(), NOW()),
('MUE0002', 'A002', 'Semillas del Sur', 'Soja', 800, NOW(), NOW()),
('MUE0003', 'A003', 'BioCampo SA', 'Maíz', 1000, NOW(), NOW()),
('MUE0004', 'A004', 'FIUBA', 'Zapallo', 1500, NOW(), NOW());

INSERT INTO resultados (muestra_id, poder_germinativo, pureza, materiales_inertes, created_at, updated_at)
VALUES
(1, 92.5, 98.0, 1.5, NOW(), NOW()),
(2, 88.0, 95.5, 2.0, NOW(), NOW()),
(3, 90.0, 96.2, 1.8, NOW(), NOW());
