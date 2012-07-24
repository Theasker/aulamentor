# Mi Club 
# En esta actividad vas a simular la gestión y mantenimiento de un club deportivo. Para ello, tienes que escribir tres ficheros de tipo sql para # que mediante sus instrucciones se lleven a cabo las operaciones siguientes:

# 1.  Crea una base de datos que se denomine “mi_club”.
CREATE database IF NOT EXISTS miclub;
USE miclub;

# 2.  Dentro de “mi_club” crea dos tablas: “socios” y “cuotas”.
# Primero si existen las borramos
DROP TABLE IF EXISTS socios;
DROP TABLE IF EXISTS cuotas; 

CREATE TABLE IF NOT EXISTS socios(
id_socio INT PRIMARY KEY AUTO_INCREMENT, 
nombre VARCHAR(15), 
apellidos VARCHAR(25),
dni  VARCHAR(9),
domicilio VARCHAR(50),
localidad VARCHAR(30),
tipo_socio ENUM('A','B','C'),
fecha_alta DATE,
fecha_baja DATE,
importe_cuota DECIMAL(8,2),
paga_ult_recibo SET ('S','N'),
anotaciones  BLOB,
INDEX apellidos_i (apellidos),
INDEX dni_i (dni)
);
CREATE TABLE IF NOT EXISTS cuotas(
id_cuota INT PRIMARY KEY AUTO_INCREMENT, 
id_socio INT,
fecha_pago  DATE,
importe_cuota DECIMAL(8,2),
anotaciones TEXT,
INDEX id_socio_i(id_socio)
);

# Introducimos datos en la tabla
INSERT INTO socios VALUE(0,"socio1","apellidos1","11111111A","domicilio1","localidad1","A","1990-10-20","2010-11-03",NULL,"S","anotaciones1");
INSERT INTO socios VALUE(0,"socio2","apellidos2","22222222A","domicilio2","localidad2","B","1991-10-20",NULL,100.32,"N","anotaciones2");
INSERT INTO socios VALUE(0,"socio3","apellidos3","33333333A","domicilio3","localidad3","A","1995-10-20",NULL,111.32,"S","anotaciones3");
INSERT INTO socios VALUE(0,"socio4","apellidos4","44444444A","domicilio4","localidad4","B","1998-10-20","2011-11-03",NULL,"S","anotaciones4");
INSERT INTO socios VALUE(0,"socio5","apellidos5","55555555A","domicilio5","localidad5","C","1999-10-20",NULL,100.32,"N","anotaciones5");
INSERT INTO socios VALUE(0,"socio6","apellidos6","66666666A","domicilio6","localidad6","A","2000-10-20",NULL,100.32,"S","anotaciones6");
INSERT INTO socios VALUE(0,"socio7","apellidos7","77777777A","domicilio7","localidad7","C","2002-10-20",NULL,100.32,"N","anotaciones7");
INSERT INTO socios VALUE(0,"socio8","apellidos8","88888888A","domicilio8","localidad8","B","2003-10-20","2012-06-03",NULL,"S","anotaciones8");

INSERT INTO cuotas VALUE(0,1,"1990-10-21",90.30,"anotaciones");
INSERT INTO cuotas VALUE(0,2,"1991-10-21",100.30,"anotaciones");
INSERT INTO cuotas VALUE(0,3,"1995-10-21",120.30,"anotaciones");
INSERT INTO cuotas VALUE(0,4,"1998-10-21",200.30,"anotaciones");
INSERT INTO cuotas VALUE(0,5,"1999-10-21",50.30,"anotaciones");
INSERT INTO cuotas VALUE(0,6,"2000-10-21",20.30,"anotaciones");
INSERT INTO cuotas VALUE(0,7,"2002-10-21",70.30,"anotaciones");
INSERT INTO cuotas VALUE(0,8,"2003-10-21",390.30,"anotaciones");
INSERT INTO cuotas VALUE(0,1,"1991-10-21",490.30,"anotaciones");
INSERT INTO cuotas VALUE(0,2,"1992-10-21",690.30,"anotaciones");
INSERT INTO cuotas VALUE(0,3,"1996-10-21",190.30,"anotaciones");
INSERT INTO cuotas VALUE(0,4,"1999-10-21",200.30,"anotaciones");
INSERT INTO cuotas VALUE(0,1,"1992-10-21",180.30,"anotaciones");
INSERT INTO cuotas VALUE(0,2,"1992-10-21",590.30,"anotaciones");
INSERT INTO cuotas VALUE(0,3,"1997-10-21",90.30,"anotaciones");

# Todos los campos de todos los registros de la tabla “socios”.
SELECT * FROM socios;

# Los campos  nombre, apellidos, fecha_alta y localidad sólo de los socios de tipo "A" o "C".
SELECT nombre, apellidos, fecha_alta, localidad FROM socios
WHERE tipo_socio = "A" or tipo_socio = "C";

# Los campos  dni, id_socio, tipo_socio y fecha_baja sólo de los socios cuyo campo paga_ult_recibo contenga "N".
SELECT dni,id_socio, tipo_socio, fecha_baja FROM socios
WHERE paga_ult_recibo = "N";

# Todos los campos de los registros de la tabla “cuotas” de aquellos socios que tengan vacío el campo fecha_baja.
SELECT cuotas.* FROM cuotas
LEFT JOIN socios ON cuotas.id_socio = socios.id_socio
WHERE socios.fecha_baja IS NULL;

# La suma de todas las cuotas pagadas por un determinado socio (esto es el importe acumulado), por ejemplo id_socio igual a 3.
SELECT c.id_socio,sum(c.importe_cuota) FROM cuotas c
WHERE c.id_socio = 3;

# Los campos nombre y importe_acumulado (campo calculado que contendrá, en euros, la cantidad acumulada que ha pagado el socio en todas las cuotas. Es decir, es la suma de todas las cuotas para un socio dado.) de los socios cuyo importe_acumulado exceda de una determinada cantidad, por ejemplo 10,00 €. Lo mismo, pero cuyo importe_cuota no sobrepase esa misma cantidad. 
SELECT * FROM(
SELECT socios.nombre, sum(cuotas.importe_cuota) AS importe_acumulado
FROM socios INNER JOIN cuotas ON socios.id_socio = cuotas.id_socio
GROUP BY socios.id_socio) ALIAS
WHERE importe_acumulado > 500;

SELECT * FROM(
SELECT socios.nombre, sum(cuotas.importe_cuota) AS importe_acumulado
FROM socios INNER JOIN cuotas ON socios.id_socio = cuotas.id_socio
GROUP BY socios.id_socio) ALIAS
WHERE importe_acumulado < 500;