# 1.  Mostrar todos los campos de todos los registros de las dos tablas.
SELECT * FROM peliculas;
SELECT * FROM clientes;

# 2.  Actualizar los datos de algunos registros de las dos tablas de forma que los cambios afecten a varios campos.
UPDATE peliculas SET  sistema ="BETA", importe_euros=666.66 WHERE titulo="titulo3";
UPDATE clientes SET anotaciones="anotpobl2", fecha_devolucion="2012-06-19" WHERE poblacion="poblacion2";

# 3.  Volver a mostrar todos los campos de todos los registros de las dos tablas.
SELECT * FROM peliculas;
SELECT * FROM clientes;

# 4.  Mostrar la informaci�n introducida en las dos tablas de la forma siguiente:
# Mostrar el n�mero de registro, el t�tulo, el pa�s y los participantes de aquellas pel�culas que se hayan producido despu�s de 1990 y que est�n alquiladas.
SELECT peliculas.registro, peliculas.titulo, peliculas.pais, peliculas.participantes 
FROM peliculas INNER JOIN clientes ON peliculas.registro = clientes.peli_alqui_actual 
WHERE year(fecha_prod) > 1990 
ORDER BY peliculas.registro;

# Mostrar los registros de la tabla clientes que no tienen ninguna pelicula alquilada y los que tienen alquilada.
SELECT * FROM clientes WHERE peli_alqui_actual IS NULL;
SELECT * FROM clientes WHERE peli_alqui_actual IS NOT NULL;

# Mostrar el t�tulo de la pel�cula, el nombre, la poblaci�n y el importe acumulado de los clientes mayores de 25 a�os que tengan una pel�cula alquilada.
SELECT peliculas.titulo, clientes.nombre, clientes.poblacion, clientes.acumulado_euros 
FROM clientes INNER JOIN peliculas ON peliculas.registro = clientes.peli_alqui_actual;

# Hallar la media de lo que se ha gastado en la producci�n de todas las pel�culas dadas de alta.
SELECT AVG(importe_euros) FROM peliculas;

# Hallar la media de lo que se ha gastado en la producci�n de todas las pel�culas dadas de alta agrupadas por sistema.
SELECT sistema, AVG(importe_euros) FROM peliculas GROUP BY sistema;

# Hallar la media de lo que se ha gastado en la producci�n de todas las pel�culas dadas de alta agrupadas por pa�s.
SELECT pais, AVG(importe_euros) FROM peliculas GROUP BY pais;

# Hallar la media de lo que han gastado en alquilar pel�culas todos los clientes.
SELECT AVG(acumulado_euros) FROM clientes;

# Hallar la media de lo que han gastado en alquilar pel�culas todos los clientes agrupados por poblaci�n.
SELECT poblacion, AVG(acumulado_euros) FROM clientes GROUP BY poblacion;

# Hallar el mayor n�mero de pel�culas alquiladas de un pa�s. Por ejemplo: �El pa�s que tiene un mayor n�mero de pel�culas alquiladas es Espa�a. Total: 6�.
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