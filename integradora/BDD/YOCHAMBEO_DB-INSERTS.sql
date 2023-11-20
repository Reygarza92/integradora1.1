USE yochambeo_db;

INSERT INTO usuarios_general
VALUES (1, 'Pedro', 'Martínez', 'pedromtz@gmail.com', 'Pass123'),
    (2, 'Juan', 'Pérez', 'juanperez@gmail.com', 'JN200433'),
    (3, 'Ana', 'Gómez', 'anagomez@gmail.com', 'Ana1Perez2'),
    (4, 'Carmen', 'López', 'carmenlopez@gmail.com', 'CaLo.1993'),
    (5, 'Enrique', 'Carrillo', 'kikecarrillo@gmail.com', '2020gmail'),
    (6, 'Marcos', 'Valle', 'marcosvalle@gmail.com', 'Estrelar19'),
    (7, 'Valeria', 'Solís', 'valesolis@gmail.com', 'vSolis10'),
    (8, 'Valentina', 'Carmona', 'valecarmona@gmail.com', 'VALE2010!'),
    (9, 'Misael', 'Almazán', 'misalmazan@gmail.com', 'linux.4rch'),
    (10, 'José', 'Mendoza', 'josemendoza@gmail.com', 'JJMM.Ma2');

INSERT INTO servicios_info
VALUES (1, 'Plomería', 'Reparación y mantenimiento de tuberías'),
    (2, 'Albañilería', 'Construcción y relacionados'),
    (3, 'Carpintería', 'Trabajos con madera'),
    (4, 'Mecánica', 'Reparación y mantenimiento de vehículos'),
    (5, 'Mantenimiento de clima', 'Reparación y mantenimiento de sistemas de refrigeración');

INSERT INTO ubicaciones
VALUES (1, 'Monterrey'),
    (2, 'General Escobedo'),
    (3, 'Apodaca'),
    (4, 'Guadalupe'),
    (5, 'Santa Catarína');

INSERT INTO ubicaciones_especificas
VALUES (1, 1, 'Centro'),
    (2, 1, 'San Bernabé'),
    (3, 1, 'Contry'),
    (4, 1, 'Estanzuela'),
    (5, 2, 'Centro'),
    (6, 2, 'Buena Vista'),
    (7, 2, 'Sendero'),
    (8, 3, 'Santa Rosa'),
    (9, 3, 'Centro'),
    (10, 3, 'Cosmópolis'),
    (11, 4, 'Dos Ríos'),
    (12, 4, 'Zertuche'),
    (13, 4, 'Tierra Propia'),
    (14, 5, 'Cerámica'),
    (15, 5, 'Fleteros');

INSERT INTO usuarios_info
VALUES (1, 1, 1, TRUE),
    (2, 2, 1, FALSE),
    (3, 1, 4, FALSE),
    (4, 5, 15, FALSE),
    (5, 4, 12, TRUE),
    (6, 5, 15, FALSE),
    (7, 3, 9, FALSE),
    (8, 2, 7, TRUE),
    (9, 4, 12, FALSE),
    (10, 3, 8, TRUE);

INSERT INTO servicios_ofrecidos
VALUES (1, 1),
    (5, 2),
    (8, 3),
    (10, 2);

INSERT INTO vacante_info
VALUES (1, 7, 2, 3, 'Mesas para parque', 'Necesito a alguien que...', NOW(), '$1000-$1200', TRUE),
    (2, 2, 1, 1, 'Destapar drenaje', 'Tengo un problema en...', NOW(), '$400-$500', TRUE);

INSERT INTO resenas
VALUES (1, 5, 'Trabajador', 10, NULL, NOW());

INSERT INTO calificaciones
VALUES (1, 10, 1, 10, 0, 0, 0),
    (5, 7.5, 2, 15, 0, 0, 0),
    (8, 9, 3, 27, 0, 0, 0),
    (10, 8, 1, 8, 0, 0, 0);