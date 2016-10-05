# modifica.sql
# 1.  Mostrar todos los campos de todos los registros de las tres tablas.
SELECT * FROM libros
UNION ALL
SELECT *, NULL, NULL FROM compradores
UNION ALL
SELECT *, NULL, NULL, NULL, NULL, NULL, NULL FROM compras;

# 2.  Actualizar los datos de algunos registros de las tres tablas de forma que los cambios afecten a varios campos.
UPDATE libros SET importe_euros = importe_euros + 2, anotaciones = "No hay anotaciones" WHERE soporte = 'CD';
UPDATE compradores SET poblacion = 'Cuenca' WHERE nombre = 'Ray';
UPDATE compras SET id_comprador = 3 WHERE compras.registro = 7;

# 3.  Volver a mostrar todos los campos de todos los registros de las tres tablas.


# 4.  Mostrar la información introducida en las tres tablas de la forma siguiente:
# Mostrar el número de registro, el título, el país y la fecha de entrada en la librería 
# de aquellos libros que se hayan adquirido en la librería después de 1990. 


# Mostrar el título del libro, el nombre, la población y el importe acumulado de los compradores mayores de 30 años.


# Hallar la media del precio de los libros.


# Hallar la media del precio de los libros agrupadas por soporte.


# Hallar la media de lo que han gastado todos los compradores y la suma total de todas las ventas realizadas. 


# Hallar la media de lo que han gastado los compradores agrupados por población y ordenador decrecientemente por el importe medio. 


# Hallar el mayor número de libros vendidos de un país. Por ejemplo: El país que tiene un mayor número de libros vendidos es España. Total: 6”.
