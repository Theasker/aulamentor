# altas.sql
# 1.  Crear una base de datos que se denomine “liga_futbol”.
create database liga_futbol;
use liga_futbol;

# 2.  Dentro de “liga_futbol” crear dos tablas: “equipos” y “partidos”.
create table if not exists equipos (
	registro INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(30) NOT NULL,
	nombre_entrenador VARCHAR(35) NOT NULL,
	nombre_campo_futbol VARCHAR(30),
	poblacion VARCHAR(25),
	anio_fundacion INT(4),
	anotaciones BLOB,
	INDEX (nombre)
);

create table if not exist partidos(
	registro INT PRIMARY KEY AUTO_INCREMENT,
	id_equipo1 INT,
	resultado_equipo1 INT,
	id_equipo2 INT,
	resultado_equipo2 INT,
	FOREIGN KEY (id_equipo1) REFERENCES equipos(registro),
	FOREIGN KEY (id_equipo2) REFERENCES equipos(registro)
);