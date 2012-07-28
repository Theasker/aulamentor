# Diversas sintaxis de la orden SELECT
 
# Abrimos la base de datos.
USE almacen;
 
# Mostramos tres campos de la tabla productos.
SELECT codigo,nombre,caduca FROM productos;
 
# Mostramos todos los campos de la tabla productos.
SELECT * FROM productos;
 
# Mostramos el campo caduca de los registros que tengan
# distinta fecha de caducidad.
SELECT DISTINCT caduca FROM productos;
 
# Contamos cu�ntos registros hay que tengan distinta
# fecha de caducidad
SELECT COUNT(DISTINCT caduca) FROM productos;
 
# Contamos cu�ntos registros hay en la tabla.
SELECT COUNT(*) FROM productos;
 
# Sumamos el campo comprado_euros de todos los registros
# de la tabla clientes.
SELECT SUM(comprado_euros) FROM clientes;
 
# Hallamos la media del campo comprado_euros de todos
# los registros de la tabla clientes.
SELECT AVG(comprado_euros) FROM clientes;
 
# Hallamos el registro que tiene m�s deudas
# en el campo deudas_euros en la tabla clientes.
SELECT MAX(deudas_euros) FROM clientes;
 
# Hallamos el registro que tiene menos deudas en el campo
# deudas_euros en la tabla clientes.
SELECT MIN(deudas_euros) FROM clientes;
 
# Mostramos el campo hom�nimo "nombre" de las tablas
# productos y clientes.
SELECT productos.nombre,clientes.nombre FROM productos,clientes;
 
# Mostramos el campo hom�nimo "nombre" de las tablas
# productos y clientes usando ahora un alias para cada tabla.
SELECT P.nombre,C.nombre FROM productos P,clientes C;
 
# Mostramos s�lo los registros de la tabla productos que
# contengan "Pala" en el campo nombre y de los que haya en
# stock m�s de 50 ejemplares cuyo precio sea superior a 10 euros.
SELECT * FROM productos 
WHERE nombre="Pala" AND stock>50 AND precio_euros>10;
 
# Mostramos s�lo el nombre y el tipo de los registros de la
# tabla clientes cuyo a�o de la fecha de alta sea posterior a 2000.
SELECT nombre,tipo FROM clientes WHERE year(alta)>2000;
 
# Mostramos s�lo el n�mero de registros de la tabla productos
# que tienen descuento y que no lo tienen.
SELECT descuento,COUNT(*) FROM productos GROUP BY descuento;
 
# Mostramos s�lo el n�mero de registros de la tabla productos
# que tienen descuento y que no lo tienen si son m�s de 1.
SELECT descuento,COUNT(*) FROM productos GROUP BY descuento 
	HAVING COUNT(*)>1;
 
# Mostramos los registros de la tabla productos
# ordenados por el campo nombre de forma ascendente.
SELECT * FROM productos ORDER BY nombre;
 
# Mostramos los registros de la tabla productos
# ordenados por el campo nombre, ahora de forma descendente.
SELECT * FROM productos ORDER BY nombre DESC;
 
# Mostramos los registros de la tabla productos
# ordenados por el campo DESCuento m�s stock.
SELECT * FROM productos ORDER BY nombre,stock;
 
# Seleccionamos todos los registros de la tabla clientes 
# que tengan alg�n registro dado de alta en la tabla compras
SELECT * FROM clientes, compras
WHERE clientes.codigo = compras.codigo_cliente
 
# Usando subconsultas repetimos la consulta anterior.
SELECT * FROM clientes
WHERE clientes.codigo IN (SELECT compras.codigo_cliente FROM compras)
 
# Usando JOIN repetimos la consulta anterior
SELECT * FROM clientes
LEFT JOIN compras ON clientes.codigo = compras.codigo_cliente