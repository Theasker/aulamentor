# 1. Mostrar los campos título, país, sistema y fecha de producción de todas las películas. 
SELECT titulo, pais, sistema, fecha_prod FROM peliculas;

# 2. Mostrar los campos título, país, sistema y fecha de producción sólo de las películas que estén alquiladas.
SELECT titulo, pais, sistema, fecha_prod FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro;

# 3. Borrar las películas que no estén alquiladas. Recomendamos usar una subquerie o borrado ampliado de registros.

# Mostramos las películas que no están alquiladas.
SELECT peliculas.* FROM peliculas 
WHERE peliculas.registro NOT IN(
SELECT clientes.peli_alqui_actual FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro);

# Mostramos todos los clientes y los que no tienen ninguna peli alquilada el campo de peli_alqui_actual sale como NULL.
SELECT peliculas.*, clientes.peli_alqui_actual FROM peliculas 
LEFT JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro
WHERE clientes.peli_alqui_actual IS NULL;

# Después de verlos los eliminamos
DELETE peliculas FROM peliculas 
LEFT JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro
WHERE clientes.peli_alqui_actual IS NULL;

# 4. Mostrar los campos título, país, sistema y fecha de producción de las películas no eliminadas.
SELECT peliculas.titulo, peliculas.pais, peliculas.sistema, peliculas.fecha_prod
FROM peliculas;

# 5. Mostrar los campos nombre, domicilio y población de todos los clientes(c es un alias de clientes).
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c;

# 6. Mostrar los campos nombre, domicilio y población de los clientes que tengan una película alquilada.
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c
WHERE c.peli_alqui_actual IS NOT NULL;

# 7. Borrar los clientes que no tengan una película alquilada.
DELETE FROM clientes
WHERE clientes.peli_alqui_actual IS NULL;

# 8. Mostrar los campos nombre, domicilio y población de los clientes no eliminados.
SELECT c.nombre, c.domicilio, c.poblacion FROM clientes c;