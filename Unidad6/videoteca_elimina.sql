# 1. Mostrar los campos título, país, sistema y fecha de producción de todas las películas. 
SELECT titulo, pais, sistema, fecha_prod FROM peliculas;

# 2. Mostrar los campos título, país, sistema y fecha de producción sólo de las películas que estén alquiladas.
SELECT titulo, pais, sistema, fecha_prod FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro;

# 3. Borrar las películas que no estén alquiladas. Recomendamos usar una subquerie o borrado ampliado de registros.
DELETE FROM peliculas WHERE peliculas.registro NOT IN(
SELECT clientes.peli_alqui_actual FROM peliculas INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro);

# 4. Mostrar los campos título, país, sistema y fecha de producción de las películas no eliminadas.

# 5. Mostrar los campos nombre, domicilio y población de todos los clientes.

# 6. Mostrar los campos nombre, domicilio y población de los clientes que tengan una película alquilada.

# 7. Borrar los clientes que no tengan una película alquilada.

# 8. Mostrar los campos nombre, domicilio y población de los clientes no eliminados.

