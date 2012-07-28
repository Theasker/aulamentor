# 1.  Mostrar todos los campos de todos los registros de las dos tablas.
SELECT * FROM peliculas;
SELECT * FROM clientes;

# 2.  Actualizar los datos de algunos registros de las dos tablas de forma que los cambios afecten a varios campos.
UPDATE peliculas SET  sistema ="BETA", importe_euros=666.66 WHERE titulo="titulo3";
UPDATE clientes SET anotaciones="anotpobl2", fecha_devolucion="2012-06-19" WHERE poblacion="poblacion2";

# 3.  Volver a mostrar todos los campos de todos los registros de las dos tablas.
SELECT * FROM peliculas;
SELECT * FROM clientes;

# 4.  Mostrar la información introducida en las dos tablas de la forma siguiente:
# Mostrar el número de registro, el título, el país y los participantes de aquellas películas que se hayan producido después de 1990 y que estén alquiladas.
SELECT peliculas.registro, peliculas.titulo, peliculas.pais, peliculas.participantes 
FROM peliculas INNER JOIN clientes ON peliculas.registro = clientes.peli_alqui_actual 
WHERE year(fecha_prod) > 1990 
ORDER BY peliculas.registro;

# Mostrar los registros de la tabla clientes que no tienen ninguna pelicula alquilada y los que tienen alquilada.
SELECT * FROM clientes WHERE peli_alqui_actual IS NULL;
SELECT * FROM clientes WHERE peli_alqui_actual IS NOT NULL;

# Mostrar el título de la película, el nombre, la población y el importe acumulado de los clientes mayores de 25 años que tengan una película alquilada.
SELECT peliculas.titulo, clientes.nombre, clientes.poblacion, clientes.acumulado_euros 
FROM clientes INNER JOIN peliculas ON peliculas.registro = clientes.peli_alqui_actual;

# Hallar la media de lo que se ha gastado en la producción de todas las películas dadas de alta.
SELECT AVG(importe_euros) FROM peliculas;

# Hallar la media de lo que se ha gastado en la producción de todas las películas dadas de alta agrupadas por sistema.
SELECT sistema, AVG(importe_euros) FROM peliculas GROUP BY sistema;

# Hallar la media de lo que se ha gastado en la producción de todas las películas dadas de alta agrupadas por país.
SELECT pais, AVG(importe_euros) FROM peliculas GROUP BY pais;

# Hallar la media de lo que han gastado en alquilar películas todos los clientes.
SELECT AVG(acumulado_euros) FROM clientes;

# Hallar la media de lo que han gastado en alquilar películas todos los clientes agrupados por población.
SELECT poblacion, AVG(acumulado_euros) FROM clientes GROUP BY poblacion;

# Hallar el mayor número de películas alquiladas de un país. Por ejemplo: “El país que tiene un mayor número de películas alquiladas es España. Total: 6”.
SELECT Max(CuentaDepais) AS Expr1
FROM (
SELECT peliculas.pais, Count(peliculas.pais) AS CuentaDepais
FROM clientes INNER JOIN peliculas ON clientes.peli_alqui_actual = peliculas.registro
GROUP BY peliculas.pais) ALIAS;

SELECT peliculas.pais, Count(peliculas.pais) CuentaDepais
FROM clientes INNER JOIN peliculas 
ON clientes.peli_alqui_actual = peliculas.registro
GROUP BY peliculas.pais
ORDER BY 2 DESC
LIMIT 1;