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


# 5. Mostrar los campos nombre, domicilio y población de todos los compradores.


# 6. Mostrar los campos nombre, domicilio y población de los clientes que hayan comprado al menos 1 libro.


# 7. Borrar los compradores que no hayan comprado nunca ningún libro.


# 8. Mostrar los campos nombre, domicilio y población de los compradores no eliminados.


# 9. Borrar base de datos libreria.
