# 1. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n de todas las pel�culas. 
SELECT titulo, pais, sistema, fecha_prod FROM peliculas;

# 2. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n s�lo de las pel�culas que est�n alquiladas.
SELECT titulo, pais, sistema, fecha_prod FROM peliculas 
INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro;

# 3. Borrar las pel�culas que no est�n alquiladas. Recomendamos usar una subquerie o borrado ampliado de registros.
DELETE FROM peliculas WHERE peliculas.registro NOT IN(
SELECT clientes.peli_alqui_actual FROM peliculas INNER JOIN clientes ON clientes.peli_alqui_actual = peliculas.registro);

# 4. Mostrar los campos t�tulo, pa�s, sistema y fecha de producci�n de las pel�culas no eliminadas.

# 5. Mostrar los campos nombre, domicilio y poblaci�n de todos los clientes.

# 6. Mostrar los campos nombre, domicilio y poblaci�n de los clientes que tengan una pel�cula alquilada.

# 7. Borrar los clientes que no tengan una pel�cula alquilada.

# 8. Mostrar los campos nombre, domicilio y poblaci�n de los clientes no eliminados.

