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

# Hallar la media de los goles de cada equipo y nombre del equipo y ordenar el resultado decrecientemente por el nº de goles. 
# Pista: se puede usar también la cláusula UNION ALL para obtener el resultado. 
# Para realizar esta consulta hemos utilizad los operadores ROUND y AVG de MySQL.
# Ocurrencias --> select email, count(email) from usuario group by email 

# Partidos jugados de cada equipo
SELECT partidos_jugados.id_equipo, sum(partidos_jugados.partidos) FROM
(SELECT id_equipo1 AS id_equipo, count(id_equipo1) AS partidos FROM partidos GROUP BY id_equipo1
UNION ALL
SELECT id_equipo2 AS id_equipo, count(id_equipo2) AS partidos FROM partidos GROUP BY id_equipo2) AS partidos_jugados
GROUP BY partidos_jugados.id_equipo;

# Goles marcados por los equipos
SELECT goles.id_equipo, sum(goles.goles) FROM
(SELECT id_equipo1 AS id_equipo, resultado_equipo1 as goles FROM partidos
UNION ALL
SELECT id_equipo2 as id_equipo, resultado_equipo2 as goles FROM partidos) AS goles
GROUP BY goles.id_equipo;

# Media de goles por partido
SELECT num_goles.id_equipo, n_jugados.partidos, num_goles.goles, (num_goles.goles / n_jugados.partidos) as media
FROM
(SELECT partidos_jugados.id_equipo, sum(partidos_jugados.partidos) AS partidos FROM
(SELECT id_equipo1 AS id_equipo, count(id_equipo1) AS partidos FROM partidos GROUP BY id_equipo1
UNION ALL
SELECT id_equipo2 AS id_equipo, count(id_equipo2) AS partidos FROM partidos GROUP BY id_equipo2) AS partidos_jugados
GROUP BY partidos_jugados.id_equipo) AS n_jugados,

(SELECT n_goles.id_equipo, sum(n_goles.goles) as goles FROM
(SELECT id_equipo1 AS id_equipo, resultado_equipo1 as goles FROM partidos
UNION ALL
SELECT id_equipo2 as id_equipo, resultado_equipo2 as goles FROM partidos) AS n_goles
GROUP BY n_goles.id_equipo) AS num_goles

WHERE n_jugados.id_equipo = num_goles.id_equipo
ORDER BY num_goles.goles DESC;

# Hallar la máxima diferencia de puntos entre todos los partidos de los equipos 
# añadiendo el nombre del equipo1 y equipo2 
# ordenados decrecientemente por la máxima diferencia de puntos (nuevo campo calculado). 
# 	Ayuda: para obtener la diferencia entre dos partidos hemos utilizado la expresión siguiente: 
#		ABS((CAST(B.resultado_equipo1 AS SIGNED)-CAST(B.resultado_equipo2 AS SIGNED))).
SELECT 
equiposa.nombre AS equipo1, 
equiposb.nombre AS equipo2,
partidos.resultado_equipo1, 
partidos.resultado_equipo2,
ABS((CAST(partidos.resultado_equipo1 AS SIGNED)-CAST(partidos.resultado_equipo2 AS SIGNED))) AS diferencia

FROM equipos AS equiposa, equipos AS equiposb, partidos
WHERE equiposa.registro = partidos.id_equipo1 AND equiposb.registro = partidos.id_equipo2
ORDER BY diferencia DESC;


# Hallar el mayor número de partidos ganados por cada equipo 
# añadiendo el nombre del equipo y ordenar el resultado decrecientemente por el nº de partidos ganados. 
# 	Pista: se puede usar también la cláusula UNION ALL para obtener el resultado.
SELECT ganador, equipos.nombre, count(ganador) AS n_ganador
FROM

(SELECT 
IF (p.resultado_equipo1 > p.resultado_equipo2 , p.id_equipo1 , IF(p.resultado_equipo1 < p.resultado_equipo2, p.id_equipo2,"empate")) AS ganador
FROM partidos p) AS ganadores, equipos
WHERE ganadores.ganador = equipos.registro
GROUP BY ganador
ORDER BY n_ganador DESC;

