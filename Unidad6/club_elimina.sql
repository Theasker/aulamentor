# 1. Muestra todos los campos de la tabla “cuotas”.
SELECT * FROM cuotas;

# 2. Borra las cuotas de los socios que tengan fecha de baja. Recomendamos utilizar una subquerie o borrado ampliado de registros. 
# primero mostramos los registros que vamos a burrar
SELECT cuotas.*, socios.fecha_baja
FROM socios LEFT JOIN cuotas ON cuotas.id_socio = socios.id_socio
WHERE socios.fecha_baja IS NOT NULL;

DELETE FROM cuotas 
FROM cuotas LEFT JOIN socios ON cuotas.id_socio = socios.id_socio
WHERE socios.fecha_baja IS NOT NULL;

# 3. Repite la operación 1 y comprueba que han sido borradas las cuotas de los socios afectados.
SELECT * FROM cuotas;

# 4. Repite las operaciones 1, 2 y 3 aplicadas ahora a la tabla “socios”.
# primero mostramos los registros que vamos a eliminar
SELECT * FROM socios
WHERE socios.fecha_baja IS NULL;

DELETE FROM socios
WHERE socios.fecha_baja IS NULL;

# 5. Finalmente, elimina las dos tablas creadas “socios” y “cuotas”. Además, acaba borrando la misma base de datos “mi_club”.
DROP TABLE IF EXISTS socios;
DROP TABLE IF EXISTS cuotas;
DROP database miclub;