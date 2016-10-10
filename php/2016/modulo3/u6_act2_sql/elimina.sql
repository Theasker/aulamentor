# elimina.sql
# 1. Mostrar los campos titulo, escritor, pais, soporte y fecha de entrada en la librería de todas los libros. 
SELECT titulo, escritor, pais, soporte, fecha_entrada_libreria
FROM libros; 

# 2. Mostrar los campos titulo, escritor, pais, soporte y fecha de entrada en la librería de todas las libros que se hayan vendido al menos 1 vez.
SELECT libros.registro, COUNT(compras.id_libro) AS n_libros
FROM libros
INNER JOIN compras
ON libros.registro = compras.id_libro
GROUP BY compras.id_libro;

# 3. Borrar los libros que no se hayan vendido nunca.

# Hago que no se haya comprado nunca el libro con registro 9
UPDATE compras SET id_libro = 3 WHERE compras.id_libro = 9;

# Libros que se no han comprado nunca
SELECT * FROM libros WHERE Not libros.registro IN
(SELECT libros.registro
FROM libros
INNER JOIN compras
ON libros.registro = compras.id_libro
GROUP BY compras.id_libro);

# Después de visualizarlos, los borro
DELETE FROM libros WHERE Not libros.registro IN
(SELECT * FROM
(SELECT libros.registro
FROM libros
INNER JOIN compras
ON libros.registro = compras.id_libro
GROUP BY compras.id_libro) AS vendidos);

# 4. Mostrar los campos titulo, escritor, pais, soporte y fecha de entrada en la librería de los libros no eliminados.
SELECT titulo, escritor, pais, soporte, fecha_entrada_libreria
FROM libros; 

# 5. Mostrar los campos nombre, domicilio y población de todos los compradores.
SELECT nombre, domicilio, poblacion
FROM compradores;

# 6. Mostrar los campos nombre, domicilio y población de los clientes que hayan comprado al menos 1 libro.
SELECT compradores.nombre, compradores.domicilio, compradores.poblacion
FROM compradores
INNER JOIN compras
ON compradores.registro = compras.id_comprador
GROUP BY compradores.nombre;

# 7. Borrar los compradores que no hayan comprado nunca ningún libro.

# Hago que los compradores con id 7 y 5 no hayan comprado ningún libro.
UPDATE compras SET id_comprador = 3 WHERE id_comprador = 7;
UPDATE compras SET id_comprador = 3 WHERE id_comprador = 5;

# Ahora borro los registros
DELETE FROM compradores WHERE compradores.registro NOT IN
(SELECT * FROM 

(SELECT id_comprador
FROM compras
INNER JOIN compradores
ON compras.id_comprador = compradores.registro
GROUP BY id_comprador) AS sin_comprar);

# 8. Mostrar los campos nombre, domicilio y población de los compradores no eliminados.
SELECT nombre, domicilio, poblacion FROM compradores;

# 9. Borrar base de datos libreria.
DROP DATABASE liga_futbol;