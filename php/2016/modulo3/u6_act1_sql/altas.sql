# altas.sql
# 1.  Crear una base de datos que se denomine “liga_futbol”.
create database liga_futbol;
use liga_futbol;

# 2.  Dentro de “liga_futbol” crear dos tablas: “equipos” y “partidos”.
drop table partidos;
drop table equipos;
create table if not exists equipos (
	registro INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(30) NOT NULL,
	nombre_entrenador VARCHAR(35) NOT NULL,
	nombre_campo_futbol VARCHAR(30),
	poblacion VARCHAR(25),
	anio_fundacion INT(4),
	anotaciones BLOB,
	INDEX (nombre)
);

create table if not exists partidos(
	registro INT PRIMARY KEY AUTO_INCREMENT,
	id_equipo1 INT NOT NULL,
	resultado_equipo1 INT NOT NULL,
	id_equipo2 INT NOT NULL,
	resultado_equipo2 INT NOT NULL,
	FOREIGN KEY (id_equipo1) REFERENCES equipos(registro),
	FOREIGN KEY (id_equipo2) REFERENCES equipos(registro)
);

insert into equipos values (1,"Equipo cosgoles","Francisco Lorin Colorado","Campo lejos","Villabajo",2005,"Ninguna anotación");
insert into equipos values (2,"shalketemeto","Aquiles Brinco ","Campo Cerca","Villarriba",2002,NULL);
insert into equipos values (3,"Tuercebotas F.C.","Armando Jaleo","Campo de alli","Villabajo",1995,NULL);
insert into equipos values (4,"Esfinter de Milan","Luz Rojas","Campo de allá","Villarriba",2007,"Ninguna anotación");
insert into equipos values (5,"Rayo Vayacaño","Marcia Ana","Campo peque","Dondesea",2005,"Alguna anotación");
insert into equipos values (6,"Milan Robao","Susana Oria","Campo Stela","Villabajo",2004,"No se si poner algo");
insert into equipos values (7,"Aston Birra","Sole Dolio","Campo Zeta","Villarriba",2002,"Pos no se me ocurre na");
insert into equipos values (8,"Borussia Pontegafas","Elvis Tek","Campo Taje","Ni se dondestá",2001,"Si es por ir, se va");
insert into equipos values (9,"Maccabi de Levantar","José Luis Lamata Feliz","Campo Svale","Villabajo",2000,"Ir pa na es tontería");
insert into equipos values (10,"Nottingham Prisas","Elsa Capunta","Campo No Juego","Villabajo",2011,"Pos vale");
insert into equipos values (11,"Vodka Juniors","Elba Calao","Campo Tingue","Villabajo",2015,"Pos bueno");

insert into partidos values (1,2,3,6,0);
insert into partidos values (2,3,2,1,7);
insert into partidos values (3,4,3,2,3);
insert into partidos values (4,5,7,3,5);
insert into partidos values (5,6,0,4,0);
insert into partidos values (6,7,0,5,0);
insert into partidos values (7,8,5,6,7);
insert into partidos values (8,9,8,7,3);
insert into partidos values (9,10,3,8,2);
insert into partidos values (10,1,4,9,1);
insert into partidos values (11,6,2,10,0);
insert into partidos values (12,1,3,7,2);
insert into partidos values (13,1,0,8,2);
insert into partidos values (14,2,0,1,0);


-- Mostrar la información introducida en las dos tablas de la forma siguiente:

-- Todos los campos de todos los registros de la tabla “equipos”.
select * from equipos;

-- Los campos nombre, entrenador y nombre del campo de fútbol sólo de los equipos de una determinada población.
select nombre,nombre_entrenador,nombre_campo_futbol from equipos where poblacion = "Villabajo";

-- Los campos nombre del equipo, población y anotaciones de los equipos cuyo nombre empieza por el carácter 'R'.
select nombre,poblacion,anotaciones from equipos WHERE nombre LIKE 'R%';

-- El número de equipos y población agrupados por la población ordenados decrecientemente por el número de equipos.
SELECT poblacion,count(nombre) as equipos, count(poblacion) from equipos group by poblacion order by equipos;

-- Año de la fundación del primer equipo.
SELECT min(anio_fundacion) FROM equipos;

# Partidos jugados: nombre del equipo1, nombre del equipo2, resultado equipo1, resultado equipo2 ordenados por el nombre del equipo1. 
# Ayuda: es recomendable usar renombramiento de tablas con 3 tablas en el SELECT. (Por ejemplo: FROM EQUIPOS A, EQUIPOS B, PARTIDOS C).
SELECT equiposa.nombre AS equipo1, equiposb.nombre AS equipo2,partidos.resultado_equipo1, partidos.resultado_equipo2 
FROM equipos AS equiposa, equipos AS equiposb, partidos
WHERE equiposa.registro = partidos.id_equipo1 AND equiposb.registro = partidos.id_equipo2;

 
# Los campos n º total de partidos jugados (campo calculado) y nombre del equipo ordenado decrecientemente por el nº de partidos jugados. 
#	Ayuda: puedes escribir 2 SELECT con el número de partidos jugados en la ida y en la vuelta por cada equipo, juntando ambos resultados usando la cláusula UNION ALL. 
#	A todo este resultado se le puede denominar una nueva tabla así: 
#		(select 1 UNION ALL select 2) as tabla y podemos trabajar con tabla como si fuera una tabla normal y corriente de esta manera: 
#			SELECT tabla.* FROM (select 1 UNION ALL select 2) as tabla ORDER BY tabla.x. 
#	Nota: si te resulta muy complicada esta solución, puedes hacer los cálculos de los partidos jugados a la ida, a la vuelta en 2 sql's separadas 
#	y, después, sumar a mano los resultados obtenidos.
	
#	Contar ocurrencias repetidas de un registro: select email, count(email) from usuario group by email 


SELECT equipos.nombre,COUNT(partidos_jugados.id_equipo) AS partidos
FROM equipos,
(SELECT id_equipo1 AS id_equipo FROM partidos
UNION ALL
SELECT id_equipo2 AS id_equipo FROM partidos)
AS partidos_jugados
WHERE equipos.registro = partidos_jugados.id_equipo
GROUP BY partidos_jugados.id_equipo
ORDER BY partidos;