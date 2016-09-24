-- modifica.sql

-- 1.  Mostrar todos los campos de todos los registros de las dos tablas.
SELECT registro,nombre,nombre_entrenador,nombre_campo_futbol,poblacion,anio_fundacion,anotaciones FROM equipos
UNION
SELECT registro,id_equipo1,resultado_equipo1,id_equipo2,resultado_equipo2,NULL,NULL FROM partidos;

select * from equipos union select *,null,null from partidos;

-- 2.  Actualizar los datos de algunos registros de las dos tablas de forma que los cambios afecten a varios campos.
3.  Volver a mostrar todos los campos de todos los registros de las dos tablas.
4.  Mostrar la información introducida en las dos tablas de la forma siguiente:
Mostrar el número de registro, el nombre equipo, la población y año de fundación de aquellos equipos fundados después de 1900.
Hallar la media de puntos de cada partido entre los dos equipos. Para realizar esta consulta hemos utilizad los operadores ROUND y AVG de MySQL.
Hallar la media de los goles de cada equipo y nombre del equipo y ordenar el resultado decrecientemente por el nº de goles. Pista: se puede usar también la cláusula UNION ALL para obtener el resultado. Para realizar esta consulta hemos utilizad los operadores ROUND y AVG de MySQL.
Hallar la máxima diferencia de puntos entre todos los partidos de los equipos añadiendo el nombre del equipo1 y equipo2 ordenados decrecientemente por la máxima diferencia de puntos (nuevo campo calculado). Ayuda: para obtener la diferencia entre dos partidos hemos utilizado la expresión siguiente: ABS((CAST(B.resultado_equipo1 AS SIGNED)-CAST(B.resultado_equipo2 AS SIGNED))).
Hallar el mayor número de partidos ganados por cada equipo añadiendo el nombre del equipo y ordenar el resultado decrecientemente por el nº de partidos ganados. Pista: se puede usar también la cláusula UNION ALL para obtener el resultado. 