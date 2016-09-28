-- modifica.sql

-- 1.  Mostrar todos los campos de todos los registros de las dos tablas.
SELECT registro,nombre,nombre_entrenador,nombre_campo_futbol,poblacion,anio_fundacion,anotaciones FROM equipos
UNION
SELECT registro,id_equipo1,resultado_equipo1,id_equipo2,resultado_equipo2,NULL,NULL FROM partidos;

select * from equipos union select *,null,null from partidos;

-- 2.  Actualizar los datos de algunos registros de las dos tablas de forma que los cambios afecten a varios campos.
UPDATE equipos SET anio_fundacion = anio_fundacion + 2, anotaciones = "No hay anotaciones";
UPDATE partidos SET resultado_equipo1 = resultado_equipo1 + 1, resultado_equipo2 = resultado_equipo2 + 1;

-- 3.  Volver a mostrar todos los campos de todos los registros de las dos tablas.
SELECT * FROM equipos UNION SELECT *,NULL,NULL,NULL FROM partidos;

-- 4.  Mostrar la información introducida en las dos tablas de la forma siguiente:

-- Mostrar el número de registro, el nombre equipo, la población y año de fundación de aquellos equipos fundados después de 1900.
SELECT registro, nombre, poblacion, anio_fundacion FROM equipos WHERE anio_fundacion > 1900;

-- Hallar la media de puntos de cada partido entre los dos equipos. 
-- Para realizar esta consulta hemos utilizado los operadores ROUND y AVG de MySQL.
SELECT 

-- Hallar la media de los goles de cada equipo y nombre del equipo y ordenar el resultado decrecientemente por el nº de goles. 
-- Pista: se puede usar también la cláusula UNION ALL para obtener el resultado. 
-- Para realizar esta consulta hemos utilizad los operadores ROUND y AVG de MySQL.

select id_equipo1, count(id_equipo1) from partidos group by id_equipo1;
select id_equipo1 as id_equipo, resultado_equipo1 as resultado from partidos union ALL select id_equipo2 as id_equipo, resultado_equipo2 as resultado from partidos;

SELECT equipos.registro, equipos.nombre, SUM(partidos_jugados.resultado) FROM

(select id_equipo1 as id_equipo, resultado_equipo1 as resultado from partidos
union ALL
select id_equipo2 as id_equipo, resultado_equipo2 as resultado from partidos)
AS partidos_jugados,

(SELECT id_equipo1 AS id_equipo, count(id_equipo1) as n_partidos from partidos group by id_equipo 
UNION ALL 
SELECT id_equipo2 AS id_equipo, count(id_equipo2) as n_partidos from partidos group by id_equipo)
AS n_partidos,
equipos

WHERE equipos.registro = partidos_jugados.id_equipo AND equipos.registro = n_partidos.id_equipo
GROUP BY partidos_jugados.id_equipo
;

Hallar la máxima diferencia de puntos entre todos los partidos de los equipos añadiendo el nombre del equipo1 y equipo2 ordenados decrecientemente por la máxima diferencia de puntos (nuevo campo calculado). Ayuda: para obtener la diferencia entre dos partidos hemos utilizado la expresión siguiente: ABS((CAST(B.resultado_equipo1 AS SIGNED)-CAST(B.resultado_equipo2 AS SIGNED))).
Hallar el mayor número de partidos ganados por cada equipo añadiendo el nombre del equipo y ordenar el resultado decrecientemente por el nº de partidos ganados. Pista: se puede usar también la cláusula UNION ALL para obtener el resultado. 


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