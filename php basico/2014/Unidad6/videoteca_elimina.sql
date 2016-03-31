# 1. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n de todas las pel�culas. 
SELECT titulo, pais, sistema, fecha_prod FROM peliculas;

# 2. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n s�lo de las pel�culas que est�n alquiladas.
SELECT titulo, pais, sistema, fecha_prod FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro;

# 3. Borrar las pel�culas que no est�n alquiladas. Recomendamos usar una subquerie o borrado ampliado de registros.

# Mostramos las pel�culas que no est�n alquiladas.
SELECT peliculas.* FROM peliculas 
WHERE peliculas.registro NOT IN(
SELECT clientes.peli_alqui_actual FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro);

# Mostramos todos los clientes y los que no tienen ninguna peli alquilada el campo de peli_alqui_actual sale como NULL.
SELECT peliculas.*, clientes.peli_alqui_actual FROM peliculas 
LEFT JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro
WHERE clientes.peli_alqui_actual IS NULL;

# Despu�s de verlos los eliminamos
DELETE peliculas FROM peliculas 
LEFT JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro
WHERE clientes.peli_alqui_actual IS NULL;

# 4. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n de las pel�culas no eliminadas.
SELECT peliculas.titulo, peliculas.pais, peliculas.sistema, peliculas.fecha_prod
FROM peliculas;

# 5. Mostrar los campos nombre, domicilio y poblaci�n de todos los clientes(c es un alias de clientes).
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c;

# 6. Mostrar los campos nombre, domicilio y poblaci�n de los clientes que tengan una pel�cula alquilada.
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c
WHERE c.peli_alqui_actual IS NOT NULL;

# 7. Borrar los clientes que no tengan una pel�cula alquilada.
DELETE FROM clientes
WHERE clientes.peli_alqui_actual IS NULL;

# 8. Mostrar los campos nombre, domicilio y poblaci�n de los clientes no eliminados.
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c;