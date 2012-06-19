# Creamos la base de daatos "videoteca"
CREATE DATABASE IF NOT EXISTS videoteca;

# Abrimos la base de datos "videoteca"
USE videoteca; 

# Borramos las tablas peliculas y clientes si existen
DROP TABLE IF EXISTS peliculas;
DROP TABLE IF EXISTS clientes; 

# Creamos las tablas "peliculas" y "clientes"
CREATE TABLE IF NOT EXISTS
peliculas(
registro INT PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR(35),
soporte SET('CIN','DVD'),
fecha_prod DATE,
pais VARCHAR(20),
sistema ENUM ('VHS','BETA','S8'),
importe_euros DECIMAL(8,2),
participantes TEXT,
anotaciones BLOB,
INDEX  titulo_i (titulo),
INDEX pais_i (pais));

CREATE TABLE IF NOT EXISTS
clientes(
registro INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(35),
fecha_nacim  DATE,
telefono VARCHAR(10), 
domicilio VARCHAR(35),
poblacion VARCHAR(25),
acumulado_euros DECIMAL(8,2),
peli_alqui_actual INT, 
fecha_devolucion DATE,
anotaciones TEXT,
INDEX nom (nombre));   

# Introducimos varios registros en las tablas peliculas y clientes
INSERT INTO peliculas VALUES (0,"titulo1","DVD","1970-01-01","pais1","VHS",3000.00,"participantes1","anotaciones1");
INSERT INTO peliculas VALUES (0,"titulo2","DVD","1995-01-01","pais2","VHS",4500.00,"participantes2","anotaciones2");
INSERT INTO peliculas VALUES (0,"titulo3","DVD","1989-01-01","pais1","VHS",6000.00,"participantes3","anotaciones3");
INSERT INTO peliculas VALUES (0,"titulo4","DVD","1969-01-01","pais3","VHS",4300.00,"participantes4","anotaciones4");
INSERT INTO peliculas VALUES (0,"titulo5","CIN","1995-01-01","pais2","BETA",5435.85,"participantes5","anotaciones5");
INSERT INTO peliculas VALUES (0,"titulo6","CIN","2001-01-01","pais1","VHS",454.85,"participantes6","anotaciones6");
INSERT INTO peliculas VALUES (0,"titulo7","DVD","1990-01-01","pais1","S8",4565.12,"participantes7","anotaciones7");
INSERT INTO peliculas VALUES (0,"titulo8","DVD","1993-01-01","pais1","S8",548.54,"participantes8","anotaciones8");

INSERT INTO clientes VALUES (0,"nombre1",1972-10-19,"111111111","domicilio1","poblacion1",33.20,2,"2012-06-15","anotaciones1");
INSERT INTO clientes VALUES (0,"nombre2",1974-01-24,"222222222","domicilio2","poblacion1",0,3,"2012-06-16","anotaciones2");
INSERT INTO clientes VALUES (0,"nombre3",1975-11-19,"333333333","domicilio3","poblacion1",32.20,1,"2012-06-15","anotaciones3");
INSERT INTO clientes VALUES (0,"nombre4",1971-12-20,"444444444","domicilio4","poblacion2",5.45,3,"2012-06-16","anotaciones4");
INSERT INTO clientes VALUES (0,"nombre5",1970-10-10,"555555555","domicilio5","poblacion1",6.20,6,"2012-06-20","anotaciones5");
INSERT INTO clientes VALUES (0,"nombre6",1974-11-04,"666666666","domicilio1","poblacion2",135.45,4,"2012-06-17","anotaciones6");
INSERT INTO clientes VALUES (0,"nombre7",1969-11-19,"777777777","domicilio7","poblacion1",1.20,NULL,NULL,"anotaciones3");
INSERT INTO clientes VALUES (0,"nombre8",1980-12-20,"888888888","domicilio8","poblacion3",3.20,NULL,NULL,"anotaciones4");

# Todos los campos de todos los registros de la tabla “peliculas”.
SELECT * FROM peliculas;

# Los campos  título, fecha de producción, país y precio en euros sólo de las películas producidas en un determinado sistema.
SELECT titulo, fecha_prod, pais, importe_euros FROM peliculas where sistema="VHS";

# El nombre, teléfono y fecha de devolución de los clientes que tengan alguna película alquilada.
SELECT nombre, telefono, fecha_devolucion FROM clientes where peli_alqui_actual>0;

# El nombre del cliente que tiene una película alquilada, título de la película que tiene alquilada y fecha de devolución.
SELECT clientes.nombre, peliculas.titulo FROM peliculas inner join clientes on peliculas.registro = clientes.peli_alqui_actual;

# La suma de los importes acumulados por todos los clientes en el alquiler de las películas (acumulado_euros) y la suma del importe de la producción (importe_euros) de todas las películas dadas de alta.
SELECT sum(clientes.acumulado_euros) FROM clientes;
SELECT sum(peliculas.importe_euros) FROM peliculas;

# La suma de los importes de producción agrupados por sistemas y suma de los alquileres pagados por los clientes agrupados por población.
SELECT  sistema, SUM(importe_euros) FROM peliculas GROUP BY sistema;
