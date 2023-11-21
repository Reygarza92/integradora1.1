-- YOCHAMBEO_DB CREATION

CREATE DATABASE yochambeo_db;
USE yochambeo_db;

CREATE TABLE usuarios_general(
    id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(20) NOT NULL
);

CREATE TABLE servicios_info(
    id_servicio INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    servicio VARCHAR(30) NOT NULL,
    descripcion VARCHAR(150) DEFAULT NULL
);

CREATE TABLE ubicaciones(
    id_localidad INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    localidad VARCHAR(60) NOT NULL
);

CREATE TABLE ubicaciones_especificas(
    id_localidad_especifica INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_localidad INT NOT NULL,
    localidad_especifica VARCHAR(60) NOT NULL,
    FOREIGN KEY (id_localidad) REFERENCES ubicaciones(id_localidad)
);

CREATE TABLE usuarios_info(
    id_usuario INT NOT NULL UNIQUE,
    id_localidad INT,
    id_localidad_especifica INT,
    ofreceServicio BOOL DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE,
    FOREIGN KEY (id_localidad) REFERENCES ubicaciones(id_localidad),
    FOREIGN KEY (id_localidad_especifica) REFERENCES ubicaciones_especificas(id_localidad_especifica)
);


CREATE TABLE servicios_ofrecidos(
    id_usuario INT NOT NULL,
    id_servicio INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES servicios_info(id_servicio)
);

CREATE TABLE vacante_info(
    id_vacante INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_servicio INT NOT NULL,
    id_localidad INT NOT NULL,
    titulo VARCHAR(30) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    pago VARCHAR(50), -- Se darán opciones de promedio de pago, por ejemplo, de 300 a 400 pesos
    vacante BOOL DEFAULT TRUE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES servicios_info(id_servicio),
    FOREIGN KEY (id_localidad) REFERENCES ubicaciones(id_localidad)
);

CREATE TABLE postulaciones(
    id_usuario INT NOT NULL,
    id_vacante INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE,
    FOREIGN KEY (id_vacante) REFERENCES vacante_info(id_vacante)
);

CREATE TABLE resenas(
    id_resena INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    rol ENUM('Empleador', 'Trabajador'),
    puntuacion INT NOT NULL,
    comentarios VARCHAR(100) DEFAULT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE
);

CREATE TABLE calificaciones(
    id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    calificacion_trabajador DECIMAL(3,1) DEFAULT 0.0,
    cantidad_trabajador INT DEFAULT 0,
    suma_trabajador INT,
    calificacion_empleador DECIMAL(3,1) DEFAULT 0.0,
    cantidad_empleador INT DEFAULT 0,
    suma_empleador INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE
);

CREATE TABLE trabajos_completados(
    id_vacante INT NOT NULL UNIQUE,
    id_usuario_empleador INT NOT NULL,
    id_usuario_trabajador INT NOT NULL,
    completado_empleador BOOL DEFAULT FALSE,
    completado_trabajador BOOL DEFAULT FALSE,
    FOREIGN KEY (id_vacante) REFERENCES vacante_info(id_vacante),
    FOREIGN KEY (id_usuario_empleador) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario_trabajador) REFERENCES usuarios_general(id_usuario) ON UPDATE CASCADE
);

CREATE TABLE conteo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    cantidad INT DEFAULT 0
);

/* Para llenar los datos habría que ver primero si ofrece, necesita servicios y/o empleo con un IF que revise el dato ing*/

/* Para logear debe de pedir correo y contraseña y debe revisarlos en la BDD */