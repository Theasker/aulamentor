# delete from <nombre de la tabla> [where <condición>]
# 1. Mostrar los campos nombre, nombre del entrenador, nombre del campo de fútbol, población y año de fundación de todos los equipos. 
SELECT nombre, nombre_entrenador, nombre_campo_futbol, poblacion, anio_fundacion FROM equipos;

# 2. Mostrar los campos nombre, nombre del entrenador, nombre del campo de fútbol, población y año de fundación.
SELECT nombre, nombre_entrenador, nombre_campo_futbol, poblacion, anio_fundacion FROM equipos;

# 3. Borrar los equipos que no hayan jugado ningún partido.
# Select * From Tabla1 where Not Codigo In (Select Codigo From Tabla2)

# Equipos que no han jugado ningún partido:
SELECT equipos.registro FROM equipos WHERE Not equipos.registro In

(SELECT p_jugados.id_equipo FROM

(SELECT id_equipo1 AS id_equipo FROM partidos
UNION ALL
SELECT id_equipo2 AS id_equipo FROM partidos) AS p_jugados

GROUP BY p_jugados.id_equipo);

# Borro esos esquipos
# DELETE FROM table_name WHERE some_column = some_value
# SELECT equipos.registro FROM equipos WHERE Not equipos.registro In (select .....)

DELETE FROM equipos WHERE Not equipos.registro In

(SELECT p_jugados.id_equipo FROM

(SELECT id_equipo1 AS id_equipo FROM partidos
UNION ALL
SELECT id_equipo2 AS id_equipo FROM partidos) AS p_jugados

GROUP BY p_jugados.id_equipo);

# 4. Mostrar los campos nombre, nombre del entrenador, nombre del campo de fútbol, población y año de fundación de los equipos no borrados.


# 5. Borrar las tablas de la base de datos liga_futbol.


# 9. Borrar base de datos liga_futbol.
