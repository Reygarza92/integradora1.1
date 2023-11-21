-- YOCHAMBEO_DB PROCEDURES

--  ____    ____     ___     ____   _____   ____    _   _   ____    _____   ____  
-- |  _ \  |  _ \   / _ \   / ___| | ____| |  _ \  | | | | |  _ \  | ____| / ___| 
-- | |_) | | |_) | | | | | | |     |  _|   | | | | | | | | | |_) | |  _|   \___ \ 
-- |  __/  |  _ <  | |_| | | |___  | |___  | |_| | | |_| | |  _ <  | |___   ___) |
-- |_|     |_| \_\  \___/   \____| |_____| |____/   \___/  |_| \_\ |_____| |____/ 

-- SIGN UP

DELIMITER //
CREATE PROCEDURE sign_up(
IN nameIN VARCHAR(30),
IN last_name VARCHAR(60),
IN email VARCHAR(100),
IN pass VARCHAR(20)
)
BEGIN
INSERT INTO usuarios_general(nombre, apellido, correo, contraseña)
VALUES (nameIN, last_name, email, pass);
END;
//
DELIMITER ;

CALL sign_up('NombreEjemplo', 'ApellidoEjemplo', 'CorreoEjemplo', 'ContraseñaEjemplo');

-- LOG IN

DELIMITER //
CREATE PROCEDURE log_in(
IN email VARCHAR(100),
IN pass VARCHAR(20)
)
BEGIN
DECLARE validez INT DEFAULT NULL;
SELECT id_usuario, nombre
FROM usuarios_general
WHERE correo = email
AND contraseña = pass;
END;
//
DELIMITER ;

CALL log_in('CorreoEjemplo', 'ContraseñaEjemplo');

/* Si el procedimiento log_in no regresa ningún valor, debe saltar un error que le pide al usuario revisar los datos ingresados */
/* Si el procedimiento regresa un valor, debe almacenarse durante toda la existencia de la página ya que es el ID del usuario y se usa en todos los procedimientos almacenados */


-- POSTULARSE
/* Se usa cuando el usuario encuentra un trabajo y se quiere postular */

DELIMITER //
CREATE PROCEDURE postulate(
IN userID INT,
IN vacantID INT
)
BEGIN
DECLARE estado VARCHAR(40);
IF ((SELECT COUNT(*) FROM postulaciones WHERE id_usuario = userID AND id_vacante = vacantID) > 0) THEN
    INSERT INTO postulaciones(id_usuario, id_vacante)
    VALUES (userID, vacantID);
    SET estado = "Se ha registrado su postulación";
ELSE
    SET estado = "Ya te has postulado a esta vacante";
END IF;
END
//
DELIMITER ;

CALL postulate('IDEjemplo', 'IDEjemplo');

/* El usuario debe dar click en la vacante donde le sale más información de ella, luego darle al botón de postularse donde se realiza este procedimiento */

-- POSTULACIONES DE LA VACANTE (SOLO PARA EMPLEADORES)
/* Este procedimiento se activa al dar click para ver los detalles de las vacantes */

DELIMITER //
CREATE PROCEDURE vacant_postulations(
IN vacantID INT
)
BEGIN
SELECT usuarios_general.nombre as nombre, usuarios_general.apellido as apellido
FROM postulaciones
LEFT JOIN usuarios_general ON postulaciones.id_usuario = usuarios_general.id_usuario
WHERE postulaciones.id_vacante = vacantID;
END;
//
DELIMITER ;

-- BÚSQUEDA DE VACANTES POR TIPO DE SERVICIO Y UBICACION

DELIMITER //
CREATE PROCEDURE lookup_vacant(
IN typeOfService VARCHAR(30),
IN ubication VARCHAR(60),
IN userID INT
)
BEGIN
SELECT VI.titulo AS titulo, SI.servicio AS servicio, VI.descripcion AS descripcion, VI.pago AS pago, UB.localidad AS localidad, DATEDIFF(VI.fecha, CURRENT_TIMESTAMP) as diasVacante, UG.nombre AS nombre
FROM vacante_info VI
LEFT JOIN usuarios_general UG on VI.id_usuario = UG.id_usuario
LEFT JOIN usuarios_info UI on VI.id_usuario = UI.id_usuario
LEFT JOIN servicios_info SI on VI.id_servicio = SI.id_servicio
LEFT JOIN ubicaciones UB on VI.id_localidad = UB.id_localidad
WHERE SI.servicio = typeOfService
AND localidad = ubication
AND vacante = TRUE
ORDER BY
CASE
    WHEN UI.id_localidad_especifica = (SELECT id_localidad_especifica FROM usuarios_info WHERE id_usuario = userID) THEN 0
ELSE 1
END;
END;
//
DELIMITER ;

CALL lookup_vacant ('VacanteEjemplo', 'LocalidadEjemplo');

/* Aquí los datos de la vacante y la localidad se seleccionan en recuadros que dan opciones, después se ejecuta un botón que busca y realiza ese query */

-- MUESTRA DE VACANTES (GENERAL)

DELIMITER //
CREATE PROCEDURE vacants(
)
BEGIN
SELECT VI.titulo AS titulo, SI.servicio AS servicio, VI.descripcion AS descripcion, VI.pago AS pago, UB.localidad AS localidad, DATEDIFF(VI.fecha, CURRENT_TIMESTAMP) AS diasVacante, UG.nombre AS nombre
FROM vacante_info VI
LEFT JOIN usuarios_general UG on VI.id_usuario = UG.id_usuario
LEFT JOIN usuarios_info UI on VI.id_usuario = UI.id_usuario
LEFT JOIN servicios_info SI on VI.id_servicio = SI.id_servicio
LEFT JOIN ubicaciones UB on VI.id_localidad = UB.id_localidad
WHERE vacante = TRUE;
END
//
DELIMITER ;


-- DECLARAR TRABAJO COMO TERMINADO
/* Para que el trabajo sea declarado como terminado, ambas partes deben de confirmar que completaron */

-- PARA EL EMPLEADOR
DELIMITER //
CREATE PROCEDURE job_finished_employer(
IN userID INT
)
BEGIN
UPDATE trabajos_completados
SET completado_empleador = TRUE;
END;
//
DELIMITER ;

-- PARA EL TRABAJADOR
DELIMITER //
CREATE PROCEDURE job_finished_worker(
IN userID INT
)
BEGIN
UPDATE trabajos_completados
SET completado_empleador = TRUE;
END;
//
DELIMITER ;

-- HISTORIAL DE TRABAJOS
/* Debe de haber un seleccionador para filtrar entre Postulaciones (trabajos a los que te postulaste) y Ofertas (trabajos que ofreces)
y depués una para filtrar entre Activos, En Proceso y Completados*/

DELIMITER //
CREATE PROCEDURE history_vacancy(
IN userID INT,
IN filterIN VARCHAR(15), -- Postulaciones // Ofertas
IN filterState VARCHAR(25) -- Completados // Pendientes // Confirmación Pendiente // En Proceso // Todos
)
BEGIN
    SELECT VI.titulo as titulo, VI.descripcion as descripcion, SI.servicio as servicio, UB.localidad as localidad,
        CASE
            WHEN TC.completado_empleador = TRUE AND TC.completado_trabajador = TRUE THEN 'Completado'
            WHEN TC.completado_empleador != TC.completado_trabajador THEN 'Confirmación Pendiente'
            WHEN TC.completado_empleador = FALSE AND TC.completado_trabajador = FALSE THEN 'En Proceso'
            WHEN TC.completado_empleador IS NULL OR TC.completado_trabajador IS NULL THEN 'Pendiente'
        END AS estado              
    FROM postulaciones PO
	LEFT JOIN vacante_info VI ON PO.id_vacante = VI.id_vacante
    LEFT JOIN servicios_info SI ON VI.id_servicio = SI.id_servicio
    LEFT JOIN ubicaciones UB ON VI.id_localidad = UB.id_localidad
    LEFT JOIN trabajos_completados TC ON VI.vacante_id = TC.vacante_id
    WHERE
        (
            (filterIN = 'Postulaciones' AND  PO.id_usuario = userID) OR
            (filterIN = 'Ofertas' AND VI.id_usuario = userID)
        )
        AND
        (
            (estado = filterState OR estado IS NOT NULL)
        );
END;
//
DELIMITER ;
/* Al dar click al botón de historial se envía el valor del ID almacenado */


-- CALIFICAR

DELIMITER //
CREATE PROCEDURE grade(
IN userID INT,

IN calification INT,
IN comments VARCHAR(100)
)
BEGIN
INSERT INTO calificaciones (id_usuario, puntuacion, comentarios)
VALUES (userID, calification, comments);
END;
//
DELIMITER ;

CALL grade_worker('IDEjemplo', 'CalificacionEjemplo', 'ComentarioEjemplo');

/* Al usuario debe de aparecerle un historial de trabajos realizados y en el historial seleccionar una tarea realizada, darle click y le debe aparecer la información de quién lo hizo y un botón para calificarlo, del botón le aparecen recuadros para ingresar la calificación y comentarios */

-- PROCEDIMIENTO PARA CUANDO ACEPTE A UN POSTULADO SE AGREGUE LA ID DEL QUE SE POSTULÓ Y DEL QUE ESTÁ OFRECIENDO EL TRABAJO A LA TABLA trabajos_completados

DELIMITER //
CREATE PROCEDURE insert_ids_into_completed_jobs(
	IN workerID INT,
	IN employerID INT,
	IN jobID INT
)
BEGIN
INSERT INTO trabajos_completados (id_vacante, id_usuario_empleador, id_usuario_trabajador)
VALUES (jobID, employerID, workerID);
END;
//
DELIMITER ;


-- PROCEDIMIENTO PARA ACTUALIZAR INFORMACIÓN DE LA VACANTE (DEBE ESTAR ACTIVA)

/* Primero se hará consulta para saber los datos de la vacante */

DELIMITER //
CREATE PROCEDURE vacant_info_show(
	IN vacantID INT
)
BEGIN
SELECT titulo, descripcion, pago
FROM vacante_info
WHERE id_vacante = vacantID;
END;
//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE vacant_info_update(
	IN vacantID INT,
	IN title VARCHAR(30),
	IN descripcionIN VARCHAR(250),
	IN payment VARCHAR(50)
)
BEGIN
UPDATE vacante_info
SET titulo = title, descripcion = descripcionIN, pago = payment
WHERE id_vacante = vacantID;
END;
//
DELIMITER ;


-- CREAR VACANTE

DELIMITER //
CREATE PROCEDURE vacant_creation(
    IN userID INT,
    IN locationIN VARCHAR(50),
    IN serviceIN VARCHAR(30),
    IN title VARCHAR(30),
    IN descripcionIN VARCHAR(250),
    IN payment VARCHAR(50)
)
BEGIN
DECLARE serviceID INT;
SET serviceID = (SELECT id_servicio FROM servicios_info WHERE servicio = serviceIN);
INSERT INTO vacante_info
VALUES (userID, serviceID, title, descripcionIN, NOW(), payment, TRUE); -- Aquí falta ver para la id_vacante
END;
//
DELIMITER ;


-- REGISTRO COMO ALGUIEN QUE OFRECE SERVICIO

DELIMITER //
CREATE PROCEDURE service_registration(
    IN userID INT,
    IN serviceIN VARCHAR(30)
)
BEGIN
DECLARE serviceID INT;
SET serviceID = (SELECT id_servicio FROM servicios_info WHERE servicio = serviceIN);
INSERT INTO servicios_ofrecidos
VALUES (userID, serviceID);
END;
//
DELIMITER ;


-- VER LA CALIFICACIÓN DE UN USUARIO

DELIMITER //
CREATE PROCEDURE rating(
    IN userID INT
)
BEGIN
SELECT calificacion_trabajador AS Trabajador, calificacion_empleador as Empleador
FROM calificaciones
WHERE id_usuario = userID;
END;
//
DELIMITER ;

-- AL LLENAR INFORMACIÓN, PROCEDIMIENTOS PARA LAS UBICACIONES

DELIMITER //
CREATE PROCEDURE location_choose()
BEGIN
SELECT localidad
FROM ubicaciones;
END;
//
DELIMITER ;

-- Al elegir una ubicación general del procedimiento anterior, el valor debe guardarse para usarse en el siguiente

DELIMITER //
CREATE PROCEDURE location_choose_specific(
    IN localidadIN VARCHAR(30)
)
BEGIN
SELECT localidad_especifica
FROM ubicaciones_especificas UE
LEFT JOIN ubicaciones U ON UE.id_localidad=U.id_localidad
WHERE U.localidad = localidadIN;
END;
//
DELIMITER ;

-- Segun el slider, mostrar a los mejores de ese servicio

DELIMITER //
CREATE PROCEDURE show_best_workers(
    IN serviceIN VARCHAR(30)
)
BEGIN
SELECT UG.id_usuario AS id_usuario, UG.nombre AS nombre, C.calificacion_trabajador AS calificacion
FROM usuarios_general UG
LEFT JOIN calificaciones C ON UG.id_usuario = C.id_usuario
LEFT JOIN servicios_ofrecidos SO ON UG.id_usuario = SO.id_usuario
LEFT JOIN servicios_info SI ON SO.id_servicio = SI.id_servicio
WHERE SI.servcio = serviceIN
AND C.calificacion_trabajador OR C.calificacion_empleador IS NOT NULL
ORDER BY calificacion_trabajador DESC;
END;
//
DELIMITER ;

-- Mejores trabajadores y su servicio ofrecido

DELIMITER //
CREATE PROCEDURE best_workers(
)
BEGIN
SELECT UG.id_usuario AS id_usuario, UG.nombre AS nombre, SI.servicio AS servicio, C.calificacion_trabajador AS calificacion
FROM usuarios_general UG
LEFT JOIN calificaciones C ON UG.id_usuario = C.id_usuario
LEFT JOIN servicios_ofrecidos SO ON UG.id_usuario = SO.id_usuario
LEFT JOIN servicios_info SI ON SO.id_servicio = SI.id_servicio
WHERE C.calificacion_trabajador OR C.calificacion_empleador IS NOT NULL
ORDER BY calificacion_trabajador DESC;
END;
//
DELIMITER ;

-- PROCEDIMIENTO DE CONTEO (Vacantes)

DELIMITER //
CREATE PROCEDURE count_vacants(
)
BEGIN
CALL vacants();
SELECT FOUND_ROWS() AS 'conteo_vacante';
END;
//
DELIMITER ;

-- PROCEDIMIENTO DE CONTEO (Trabajadores)

DELIMITER //
CREATE PROCEDURE count_worker(
)
BEGIN
CALL best_workers();
SELECT FOUND_ROWS() AS 'conteo_trabajadores';
END;
//
DELIMITER ;


--  _____   ____    ___    ____    ____   _____   ____    ____  
-- |_   _| |  _ \  |_ _|  / ___|  / ___| | ____| |  _ \  / ___| 
--   | |   | |_) |  | |  | |  _  | |  _  |  _|   | |_) | \___ \ 
--   | |   |  _ <   | |  | |_| | | |_| | | |___  |  _ <   ___) |
--   |_|   |_| \_\ |___|  \____|  \____| |_____| |_| \_\ |____/ 

-- TRIGGER PARA CUANDO ACEPTE A UNO, SE BORREN LOS POSTULADOS EN LA TABLA postulaciones Y YA NO APAREZCA VACANTE EN vacante_info, SE VUELVE FALSE

DELIMITER //
CREATE TRIGGER postulation_delete
AFTER INSERT ON trabajos_completados
FOR EACH ROW
BEGIN
DELETE FROM postulaciones
WHERE id_vacante = NEW.id_vacante; -- Elimina las postulaciones a vacantes cuyo ofrecedor ya eligió a un postulado
UPDATE postulaciones
SET vacante = FALSE
WHERE id_vacante = NEW.id_vacante; -- Actualiza el valor de la vacante de VERDADERO a FALSO para informar que ya no está vacante y asi no aparezca al realizar el procedimiento buscar_vacante
END;
//
DELIMITER ;

-- TRIGGER PARA CUANDO CALIFIQUEN, SE ACTUALICE LA CALIFICACIÓN EN LA TABLA calificaciones

DELIMITER //
CREATE TRIGGER rating_update
AFTER INSERT ON resenas
FOR EACH ROW
BEGIN
DECLARE rolIN VARCHAR(25);
SELECT NEW.rol INTO rolIN FROM resenas;
IF rolIN = "Empleador" THEN
    UPDATE calificaciones
    SET cantidad_empleador = cantidad_empleador + 1,
        suma_empleador = suma_empleador + NEW.puntuacion,
        calificacion_empleador = suma_empleador/cantidad_empleador
    WHERE NEW.id_usuario = id_usuario;
ELSE
    UPDATE calificaciones
    SET cantidad_trabajador = cantidad_trabajador + 1,
        suma_trabajador = suma_trabajador + NEW.puntuacion,
        calificacion_trabajador = suma_trabajador/cantidad_trabajador
    WHERE NEW.id_usuario = id_usuario;
END IF;
END;
//
DELIMITER ;

-- TRIGGER PARA CONTAR USUARIOS REGISTRADOS POR DIA

DELIMITER //

CREATE TRIGGER actualizar_visitas 
AFTER INSERT ON usuarios_general
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM conteo WHERE fecha = CURDATE()) > 0 THEN
        UPDATE conteo SET cantidad = cantidad + 1 WHERE fecha = CURDATE();
    ELSE
        INSERT INTO conteo (fecha, cantidad) VALUES (CURDATE(), 1);
    END IF;
END //

DELIMITER ;