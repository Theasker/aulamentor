# 1.  Muestra todos los campos de todos los registros de las dos tablas.
SELECT * FROM socios;
SELECT * FROM cuotas;

# 2.  Actualiza los datos de las dos tablas de la forma siguiente:
# El campo importe_cuota de todos los registros de la tabla “socios” de forma que los socios de tipo "C" paguen una cuota mensual de 9,35 €, los de tipo "B" un 15% más de la cuota mensual actual y los de tipo "A" un 25% más de la cuota mensual actual.
UPDATE socios LEFT JOIN cuotas ON cuotas.id_socio = socios.id_socio
SET socios.importe_cuota = 9.35
WHERE socios.tipo_socio = "C" AND socios.importe_cuota IS NOT NULL;

UPDATE socios LEFT JOIN cuotas ON cuotas.id_socio = socios.id_socio
SET socios.importe_cuota = socios.importe_cuota* 1.15
WHERE socios.tipo_socio = "B" AND socios.importe_cuota IS NOT NULL;

UPDATE socios LEFT JOIN cuotas ON cuotas.id_socio = socios.id_socio
SET socios.importe_cuota = socios.importe_cuota *  1.25
WHERE socios.tipo_socio = "A" AND socios.importe_cuota IS NOT NULL;

# El campo importe_cuota de todos los registros de la tabla “cuotas” teniendo en cuenta la nueva cuota fijada en la operación anterior. 
UPDATE cuotas LEFT JOIN socios ON cuotas.id_socio = socios.id_socio
SET cuotas.importe_cuota = socios.importe_cuota
WHERE socios.importe_cuota IS NOT NULL;

# 3.  Muestra de nuevo todos los campos de todos los registros de las dos tablas para comprobar si se han actualizado los datos tal como se pretendía.
SELECT * FROM socios;
SELECT * FROM cuotas;

# 4.  Muestra la información introducida en las dos tablas de la forma siguiente:
# Los campos  nombre, apellidos, fecha_alta y localidad sólo de los socios que hayan sido dados de alta a partir de una fecha, según los datos que hayas introducido.
SELECT s.nombre, s.apellidos, s.fecha_alta, s.localidad FROM socios s
WHERE s.fecha_alta > "2000-01-01";

# Los campos dni, fecha_baja y importe_acumulado de los socios que están dados de baja, es decir, que tienen contenido en el campo fecha_baja.
SELECT socios.dni, socios.fecha_baja, sum(cuotas.importe_cuota) AS importe_acumulado
FROM socios INNER JOIN cuotas ON cuotas.id_socio = socios.id_socio
WHERE socios.fecha_baja IS NOT NULL
GROUP BY socios.id_socio;

# Halla la media de las cuotas pagadas por todos los socios.
SELECT cuotas.id_socio, AVG(importe_cuota)
FROM cuotas
GROUP BY cuotas.id_socio;

# Halla la media y la suma del importe que figure en el campo importe_acumulado sólo de los socios que estén dados de alta.
SELECT AVG(importe_acumulado), SUM(importe_acumulado) FROM(
SELECT socios.dni, socios.fecha_baja, sum(cuotas.importe_cuota) AS importe_acumulado
FROM socios INNER JOIN cuotas ON cuotas.id_socio = socios.id_socio
WHERE socios.fecha_baja IS NOT NULL
GROUP BY socios.id_socio) ALIAS;

# Ordena los socios por el campo id_socio de forma que se muestre una lista con los campos nombre, apellidos, dni, fecha_pago y importe_cuota con todas las cuotas pagadas.
SELECT socios.nombre, socios.apellidos, socios.dni, cuotas.fecha_pago, cuotas.importe_cuota 
FROM socios INNER JOIN cuotas ON cuotas.id_socio = socios.id_socio
WHERE socios.paga_ult_recibo = "S"
ORDER BY socios.id_socio;

# Indica el número de socios dados de alta. Además, desglosa este número en socios de tipo "A", de tipo "B" y de tipo "C".
SELECT socios.tipo_socio, COUNT(socios.tipo_socio)
FROM socios
GROUP BY socios.tipo_socio;
