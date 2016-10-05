# 1.  Crear una base de datos que se denomine “libreria”.
create database libreria;
use libreria;

# 2.  Dentro de “libreria” crear tres tablas: “libros”, “compradores” y “compras”.
drop table compras;
drop table libros;
drop table compradores;

/* Puedes decidir tú la estructura de las tres tablas. Te sugerimos que sea similar a la siguiente:
Tabla “libros”
Nombre del campo Tipo y tamaño Índice
registro Numérico Único,primario,autoincremento
titulo Cadena, 35 Sí
escritor Cadena, 35 No
editorial Cadena, 20 No
soporte SET ('LIBRO', 'CD', 'DVD') No
fecha_entrada_libreria Fecha No
pais Cadena, 20 Sí
importe_euros Decimal (8,2) No
anotaciones BLOB
 
El campo importe_euros contendrá lo que cuesta comprar un ejemplar.
*/
CREATE TABLE IF NOT EXISTS libros(
	registro INT PRIMARY KEY AUTO_INCREMENT,
	titulo VARCHAR(35) NOT NULL,
	escritor VARCHAR(35) NOT NULL,
	editorial VARCHAR(20),
	soporte SET ('LIBRO', 'CD', 'DVD'),
	fecha_entrada_libreria DATETIME NOT NULL,
	pais VARCHAR(20) NOT NULL,
	importe_euros DECIMAL(8,2),
	anotaciones BLOB,
	INDEX (titulo,pais)
);

/*
Tabla “compradores”
Nombre del campo Tipo y tamaño Índice
registro Numérico Único,primario,autoincremento
nombre Cadena, 35 Sí
fecha_nacim Fecha No
telefono Cadena, 10 No
domicilio Cadena, 35 No
poblacion Cadena, 25 No
anotaciones TEXT
*/
CREATE TABLE IF NOT EXISTS compradores(
	registro INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(35) NOT NULL,
	fecha_nacim DATETIME NOT NULL,
	telefono VARCHAR(10),
	domicilio VARCHAR(35),
	poblacion VARCHAR(25),
	anotaciones TEXT,
	INDEX (nombre)
);

/*
Tabla “compras” Nombre del campo Tipo y tamaño Índice 
registro Numérico Único,primario,autoincremento
id_libro Numérico No
id_comprador Numérico No

En esta tabla se asocian mediante los campos registro de la tabla libros y la tabla compradores en los campos id_libro y id_comprador respectivamente, las compras que se han realizado nuestros clientes. 
*/
CREATE TABLE IF NOT EXISTS compras(
	registro INT PRIMARY KEY AUTO_INCREMENT,
	id_libro INT,
	id_comprador INT,
	FOREIGN KEY (id_libro) REFERENCES libros(registro),
	FOREIGN KEY (id_comprador) REFERENCES compradores(registro)
);

/*
3.  Introducir de 8 a 10 registros en cada tabla con datos variados y coherentes, que puedes inventar, 
 		para que sea posible realizar consultas con resultados. 
 		Conviene que leas antes el tipo de consultas que se van a pedir para introducir los datos que convenga. 
 		Las consultas aparecen en el punto 4 de los dos primeros scripts sql.
 		
 		http://www.generatedata.com/
*/
INSERT INTO `libros` 
(`registro`,`titulo`,`escritor`,`editorial`,`soporte`,`fecha_entrada_libreria`,`pais`,`importe_euros`,`anotaciones`) 
VALUES 
(1,"eleifend","Amery","Vehicula Aliquet Ltd","LIBRO","2015-11-15 00:41:26","Aruba","0.98","Lorem ipsum"),
(2,"enim, gravida sit amet, dapibus id, blandit at, nisi. Cum","Chantale","Cras Corp.","LIBRO","2017-08-28 03:42:31","Vanuatu","4.32","Lorem ipsum dolor sit amet,"),
(3,"Praesent","Carlos","Sed LLP","CD","2016-12-06 02:33:30","Uganda","6.08","Lorem ipsum dolor sit amet,"),
(4,"massa. Mauris vestibulum, neque sed","Norman","Egestas Aliquam PC","CD","2015-11-15 08:58:48","Bolivia","3.72","Lorem ipsum"),
(5,"rutrum eu, ultrices sit amet, risus. Donec nibh enim, gravida","Nyssa","Nunc Commodo Ltd","DVD","2017-05-23 12:48:12","Uganda","0.47","Lorem ipsum dolor sit amet, consectetuer adipiscing"),(
6,"erat","Mikayla","Ipsum Non Associates","DVD","2016-07-30 07:52:39","Brazil","0.27","Lorem ipsum dolor sit amet, consectetuer adipiscing"),
(7,"Sed pharetra, felis eget varius ultrices, mauris","Calista","Tincidunt Company","DVD","2016-01-31 08:37:40","Marshall Islands","6.03","Lorem"),
(8,"et, rutrum eu, ultrices sit amet, risus. Donec nibh enim,","Berk","Nisl Nulla Limited","CD","2017-03-16 09:49:56","United Kingdom (Great Britain)","0.79","Lorem ipsum dolor"),
(9,"Cras vehicula aliquet libero. Integer in","Amal","Et Incorporated","DVD","2015-10-29 19:31:54","Bahrain","7.94","Lorem ipsum dolor"),
(10,"aliquam eu,","Brenda","Nam Porttitor Scelerisque Consulting","DVD","2015-12-11 04:02:05","Holy See (Vatican City State)","9.42","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur");


INSERT INTO `compradores` 
(`registro`,`nombre`,`fecha_nacim`,`telefono`,`domicilio`,`poblacion`,`anotaciones`) 
VALUES 
(1,"Urielle","2016-07-28 14:12:33","536915160","5814 Nulla Carretera","Fortaleza","eget metus. In nec orci."),
(2,"Ray","2016-09-18 00:28:56","324741379","6327 Magna, Avenida","Oviedo","ac sem ut dolor dapibus gravida. Aliquam"),
(3,"Aiko","2016-01-23 15:21:15","956877631","Apartado núm.: 710, 7458 Tortor Avenida","Langley","magna."),
(4,"Bevis","2016-08-21 07:42:34","815635308","Apartado núm.: 301, 1030 Blandit Ctra.","Caledon","magnis dis parturient montes, nascetur ridiculus mus. Proin vel"),
(5,"Juliet","2016-12-09 03:40:17","586972611","381-8961 Ornare, Avenida","Barranca","et netus et malesuada fames ac turpis egestas."),
(6,"Kermit","2017-07-20 12:46:37","649319594","Apdo.:848-6529 Feugiat. Calle","Saint-Nicolas","erat nonummy ultricies ornare, elit elit fermentum risus,"),
(7,"Lester","2016-07-20 03:44:15","203817382","Apdo.:206-2145 Sollicitudin Carretera","Dudzele","Fusce mi lorem, vehicula et, rutrum eu, ultrices sit"),
(8,"Carson","2017-03-18 14:44:27","462816283","165 Lacus C/","Sheikhupura","elit pede, malesuada vel, venenatis vel, faucibus id,"),
(9,"Kennedy","2016-03-05 07:38:53","953491126","Apdo.:569-4003 Ipsum Avenida","Homburg","mollis vitae, posuere at, velit."),
(10,"Bertha","2017-03-23 15:29:31","694837193","Apartado núm.: 465, 1080 In Avenida","Dresden","faucibus orci luctus et ultrices posuere cubilia"),
(11,"Bianca","2017-04-03 06:30:34","708485251","3721 Rhoncus. C/","Penhold","In lorem. Donec"),
(12,"Angela","2016-06-14 18:51:10","993230610","9791 Nulla ","Güstrow","metus. In lorem. Donec elementum, lorem ut aliquam"),
(13,"Gabriel","2016-09-30 09:40:58","852837953","174-8060 Molestie Avda.","Acquasanta Terme","mauris"),
(14,"Hector","2016-07-10 21:08:23","401591954","Apdo.:893-2048 Enim ","Gaasbeek","taciti sociosqu ad litora torquent per conubia"),
(15,"Gisela","2017-04-09 10:19:24","299939409","Apartado núm.: 516, 8212 Gravida Calle","Mumbai","elit sed consequat auctor, nunc");

INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (1,1,15),(2,6,6),(3,9,1),(4,9,7),(5,4,2),(6,3,10),(7,6,2),(8,8,3),(9,2,5),(10,7,3);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (11,5,2),(12,7,4),(13,4,9),(14,3,5),(15,6,13),(16,2,1),(17,4,8),(18,10,13),(19,1,15),(20,6,10);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (21,8,13),(22,2,14),(23,10,13),(24,2,11),(25,3,11),(26,4,8),(27,2,10),(28,9,1),(29,2,8),(30,2,5);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (31,3,14),(32,4,3),(33,8,2),(34,2,14),(35,2,14),(36,7,2),(37,1,7),(38,2,7),(39,9,6),(40,10,2);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (41,3,6),(42,2,9),(43,7,12),(44,7,4),(45,1,15),(46,8,2),(47,7,10),(48,2,11),(49,1,12),(50,6,12);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (51,3,3),(52,4,7),(53,3,5),(54,10,9),(55,10,3),(56,2,5),(57,9,14),(58,3,7),(59,9,10),(60,7,9);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (61,8,12),(62,2,3),(63,4,4),(64,10,15),(65,2,7),(66,3,8),(67,5,3),(68,9,1),(69,1,3),(70,10,7);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (71,5,7),(72,5,12),(73,2,9),(74,2,12),(75,6,3),(76,2,5),(77,7,8),(78,2,3),(79,6,15),(80,5,3);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (81,6,7),(82,5,5),(83,8,12),(84,9,13),(85,4,6),(86,2,2),(87,4,4),(88,9,3),(89,2,10),(90,7,7);
INSERT INTO `compras` (`registro`,`id_libro`,`id_comprador`) VALUES (91,4,8),(92,4,7),(93,2,4),(94,9,9),(95,5,12),(96,7,9),(97,1,3),(98,3,1),(99,2,4),(100,6,8);

# 4.  Mostrar la información introducida en las dos tablas de la forma siguiente:
# Todos los campos de todos los registros de la tabla “libros”.
SELECT * FROM libros;

# Los campos título, escritor, país y precio en euros sólo de los libros producidas en un determinado soporte.
SELECT titulo, escritor, pais, importe_euros FROM libros 
WHERE soporte = 'LIBRO';

# El nombre, teléfono y anotaciones de los compradores cuyo nombre empiece por el carácter 'R'.
SELECT nombre, telefono, anotaciones FROM compradores WHERE nombre LIKE "R%";

# El número de libros y país agrupados por el país ordenados decrecientemente por el número de libros.
SELECT pais, count(pais) AS num
FROM libros 
GROUP BY pais
ORDER BY num DESC;

# Precio del libro más caro.
SELECT MAX(importe_euros) AS importe_max  FROM libros;


# El nombre de los compradores que han comprado al menos un libro, número de libros comprados 
# ordenado decrecientemente por el número total de libros comprados.
SELECT compradores.nombre, count(compras.id_comprador) AS num
FROM compradores
INNER JOIN compras
ON compradores.registro = compras.id_comprador
GROUP BY compras.id_comprador
ORDER BY num DESC;

# Ventas totales: 
# título del libro y suma de los importes acumulados por cada libro de todos los compradores agrupados por el título del libro.
SELECT libros.titulo, SUM(libros.importe_euros) AS total
FROM libros
INNER JOIN compras
ON libros.registro = compras.id_libro
GROUP BY libros.titulo;

# Libros adquiridos por los compradores: nombre del comprador, título del libro 
# ordenando el resultado por el nombre del comprador.
SELECT compradores.nombre, libros.titulo
FROM compras,compradores,libros
WHERE compradores.registro = compras.id_comprador AND
compras.id_libro = libros.registro
ORDER BY compradores.nombre;