-- Inserta muestras de ejemplo
INSERT INTO muestras (codigo, numero_precinto, empresa, especie, cantidad_semillas, created_at, updated_at)
VALUES
('MUE0004', 'A001', 'AgroLab SRL', 'Trigo', 500, NOW(), NOW()),
('MUE0005', 'A002', 'Semillas del Sur', 'Soja', 800, NOW(), NOW()),
('MUE0006', 'A003', 'BioCampo SA', 'Maíz', 1000, NOW(), NOW());

-- Inserta resultados de ejemplo asociados
INSERT INTO resultados (muestra_id, poder_germinativo, pureza, materiales_inertes, created_at, updated_at)
VALUES
(1, 92.5, 98.0, 1.5, NOW(), NOW()),
(2, 88.0, 95.5, 2.0, NOW(), NOW()),
(3, 90.0, 96.2, 1.8, NOW(), NOW());
