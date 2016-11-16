# https://www.mockaroo.com/

SET NAMES UTF8;
CREATE DATABASE  IF NOT EXISTS ejercicios;

USE ejercicios;

#
# Estructura tabla 'producto'
#

DROP TABLE IF EXISTS productos;
CREATE TABLE IF NOT EXISTS productos (
  id int(4) NOT NULL auto_increment,
  titulo varchar(55) NOT NULL DEFAULT '' ,
  artista varchar(55) NOT NULL DEFAULT '' ,
  genero varchar(250) ,
  stock int(3) UNSIGNED NOT NULL DEFAULT '0' ,
  precio double NOT NULL DEFAULT '0' ,
	PRIMARY KEY (id),
  KEY titulo (titulo),
  KEY artista (artista)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


#
# Datos tabla'discos'
#
insert into productos (id, titulo, artista, genero, stock, precio) values (1, 'curabitur convallis duis consequat', 'Lillian Rogers', 'auctor gravida', 50, '1.38');
insert into productos (id, titulo, artista, genero, stock, precio) values (2, 'mattis pulvinar', 'Irene Williamson', 'vel', 19, '8.13');
insert into productos (id, titulo, artista, genero, stock, precio) values (3, 'mi', 'Charles Diaz', 'consequat nulla', 37, '8.47');
insert into productos (id, titulo, artista, genero, stock, precio) values (4, 'duis bibendum morbi non', 'Jacqueline Snyder', 'parturient montes', 26, '2.01');
insert into productos (id, titulo, artista, genero, stock, precio) values (5, 'ut dolor morbi vel lectus', 'Annie Diaz', 'nulla', 13, '9.49');
insert into productos (id, titulo, artista, genero, stock, precio) values (6, 'diam id ornare', 'Alan Howard', 'aenean sit', 34, '8.30');
insert into productos (id, titulo, artista, genero, stock, precio) values (7, 'praesent blandit nam', 'Kimberly Patterson', 'magna', 47, '9.08');
insert into productos (id, titulo, artista, genero, stock, precio) values (8, 'phasellus sit amet erat', 'Jonathan Roberts', 'vestibulum sit', 40, '0.86');
insert into productos (id, titulo, artista, genero, stock, precio) values (9, 'orci luctus et', 'Alice Mills', 'lectus in', 41, '0.51');
insert into productos (id, titulo, artista, genero, stock, precio) values (10, 'non velit donec diam', 'Andrew Torres', 'curabitur', 37, '8.41');
insert into productos (id, titulo, artista, genero, stock, precio) values (11, 'odio cras mi pede malesuada', 'Brandon Gray', 'accumsan', 17, '9.10');
insert into productos (id, titulo, artista, genero, stock, precio) values (12, 'at lorem integer tincidunt', 'Helen Hicks', 'arcu', 39, '4.67');
insert into productos (id, titulo, artista, genero, stock, precio) values (13, 'tincidunt eget', 'Shawn Lopez', 'odio donec', 4, '2.51');
insert into productos (id, titulo, artista, genero, stock, precio) values (14, 'morbi', 'Joshua Howell', 'sem', 40, '5.11');
insert into productos (id, titulo, artista, genero, stock, precio) values (15, 'id mauris vulputate', 'Julia Bishop', 'phasellus sit', 2, '8.11');
insert into productos (id, titulo, artista, genero, stock, precio) values (16, 'in', 'Catherine Wheeler', 'lectus', 25, '0.69');
insert into productos (id, titulo, artista, genero, stock, precio) values (17, 'amet', 'Albert Ortiz', 'pulvinar', 16, '5.96');
insert into productos (id, titulo, artista, genero, stock, precio) values (18, 'est risus auctor', 'Ernest Rice', 'platea dictumst', 24, '7.54');
insert into productos (id, titulo, artista, genero, stock, precio) values (19, 'mauris enim leo', 'Beverly Morrison', 'pellentesque at', 46, '9.33');
insert into productos (id, titulo, artista, genero, stock, precio) values (20, 'turpis integer', 'Janet Gomez', 'sit amet', 50, '1.64');
insert into productos (id, titulo, artista, genero, stock, precio) values (21, 'sit amet', 'Roy Welch', 'lacinia', 17, '2.01');
insert into productos (id, titulo, artista, genero, stock, precio) values (22, 'pede malesuada', 'Dorothy Alvarez', 'odio elementum', 10, '9.48');
insert into productos (id, titulo, artista, genero, stock, precio) values (23, 'nulla ac enim in tempor', 'Harold Morris', 'luctus cum', 26, '1.08');
insert into productos (id, titulo, artista, genero, stock, precio) values (24, 'felis donec', 'Marie Pierce', 'mauris', 39, '8.75');
insert into productos (id, titulo, artista, genero, stock, precio) values (25, 'mi sit amet', 'Roger Garcia', 'est quam', 27, '6.31');
insert into productos (id, titulo, artista, genero, stock, precio) values (26, 'pellentesque quisque porta volutpat', 'Katherine Ford', 'turpis', 25, '6.34');
insert into productos (id, titulo, artista, genero, stock, precio) values (27, 'sem', 'Heather Woods', 'primis in', 6, '8.19');
insert into productos (id, titulo, artista, genero, stock, precio) values (28, 'gravida nisi at', 'Robin Stevens', 'tincidunt', 2, '9.73');
insert into productos (id, titulo, artista, genero, stock, precio) values (29, 'imperdiet sapien urna pretium', 'Phillip Robertson', 'in', 21, '7.71');
insert into productos (id, titulo, artista, genero, stock, precio) values (30, 'etiam vel augue vestibulum', 'Wanda Barnes', 'felis', 9, '1.91');
insert into productos (id, titulo, artista, genero, stock, precio) values (31, 'in felis eu sapien', 'Paul Wheeler', 'est phasellus', 23, '8.17');
insert into productos (id, titulo, artista, genero, stock, precio) values (32, 'duis consequat dui', 'Nancy Wells', 'velit', 42, '7.36');
insert into productos (id, titulo, artista, genero, stock, precio) values (33, 'faucibus orci luctus et', 'Frances Simmons', 'ipsum primis', 33, '7.64');
insert into productos (id, titulo, artista, genero, stock, precio) values (34, 'morbi a ipsum', 'Jose Lynch', 'ante ipsum', 34, '2.76');
insert into productos (id, titulo, artista, genero, stock, precio) values (35, 'pede malesuada in', 'Craig Spencer', 'curabitur', 29, '6.53');
insert into productos (id, titulo, artista, genero, stock, precio) values (36, 'nulla justo aliquam', 'Cheryl Murray', 'non', 24, '7.30');
insert into productos (id, titulo, artista, genero, stock, precio) values (37, 'orci luctus et ultrices posuere', 'Craig Olson', 'sed', 20, '9.21');
insert into productos (id, titulo, artista, genero, stock, precio) values (38, 'cubilia curae nulla dapibus dolor', 'Katherine Murray', 'sed', 46, '6.96');
insert into productos (id, titulo, artista, genero, stock, precio) values (39, 'gravida nisi at', 'Patricia Wilson', 'tristique fusce', 49, '8.87');
insert into productos (id, titulo, artista, genero, stock, precio) values (40, 'ante ipsum primis', 'Harold Ruiz', 'parturient', 6, '4.04');
insert into productos (id, titulo, artista, genero, stock, precio) values (41, 'in est risus', 'Wanda Tucker', 'metus', 9, '9.76');
insert into productos (id, titulo, artista, genero, stock, precio) values (42, 'condimentum', 'Nancy Harrison', 'cubilia', 27, '8.34');
insert into productos (id, titulo, artista, genero, stock, precio) values (43, 'maecenas tincidunt lacus at', 'Carol Holmes', 'leo', 21, '2.34');
insert into productos (id, titulo, artista, genero, stock, precio) values (44, 'laoreet ut rhoncus aliquet', 'Howard Perry', 'aliquam', 19, '1.03');
insert into productos (id, titulo, artista, genero, stock, precio) values (45, 'quis odio consequat varius integer', 'Julia Bailey', 'dolor sit', 24, '8.23');
insert into productos (id, titulo, artista, genero, stock, precio) values (46, 'ac enim in tempor turpis', 'Frances Bowman', 'amet justo', 13, '7.18');
insert into productos (id, titulo, artista, genero, stock, precio) values (47, 'aliquet at', 'Sara Carter', 'magna vulputate', 6, '7.23');
insert into productos (id, titulo, artista, genero, stock, precio) values (48, 'leo odio porttitor id', 'Keith Gray', 'id justo', 43, '2.62');
insert into productos (id, titulo, artista, genero, stock, precio) values (49, 'orci eget orci vehicula', 'Julia Barnes', 'volutpat quam', 45, '0.57');
insert into productos (id, titulo, artista, genero, stock, precio) values (50, 'accumsan', 'Sarah Medina', 'mauris', 10, '2.33');
insert into productos (id, titulo, artista, genero, stock, precio) values (51, 'luctus et ultrices', 'Nicholas Fernandez', 'ut', 11, '5.33');
insert into productos (id, titulo, artista, genero, stock, precio) values (52, 'et ultrices posuere cubilia curae', 'Carlos Fernandez', 'quam', 21, '1.47');
insert into productos (id, titulo, artista, genero, stock, precio) values (53, 'augue', 'Sean Porter', 'vel ipsum', 47, '5.10');
insert into productos (id, titulo, artista, genero, stock, precio) values (54, 'vestibulum eget', 'Lois Fernandez', 'sagittis nam', 12, '0.15');
insert into productos (id, titulo, artista, genero, stock, precio) values (55, 'ac', 'Alice Black', 'suspendisse', 22, '8.99');
insert into productos (id, titulo, artista, genero, stock, precio) values (56, 'luctus', 'Andrew Edwards', 'diam erat', 20, '0.60');
insert into productos (id, titulo, artista, genero, stock, precio) values (57, 'condimentum id luctus nec', 'Stephen Ramirez', 'tellus', 1, '1.62');
insert into productos (id, titulo, artista, genero, stock, precio) values (58, 'libero nullam sit', 'Bonnie Ford', 'et magnis', 42, '7.26');
insert into productos (id, titulo, artista, genero, stock, precio) values (59, 'pellentesque ultrices phasellus', 'Theresa Miller', 'mauris lacinia', 21, '9.72');
insert into productos (id, titulo, artista, genero, stock, precio) values (60, 'id luctus nec', 'Juan Ford', 'turpis sed', 50, '7.05');
insert into productos (id, titulo, artista, genero, stock, precio) values (61, 'ut at dolor quis', 'Antonio Brooks', 'vulputate elementum', 3, '2.69');
insert into productos (id, titulo, artista, genero, stock, precio) values (62, 'in magna bibendum imperdiet', 'Philip Ford', 'morbi odio', 16, '4.40');
insert into productos (id, titulo, artista, genero, stock, precio) values (63, 'lobortis est phasellus', 'Mary Flores', 'ut massa', 4, '1.33');
insert into productos (id, titulo, artista, genero, stock, precio) values (64, 'morbi porttitor', 'Jason Young', 'massa', 24, '1.54');
insert into productos (id, titulo, artista, genero, stock, precio) values (65, 'etiam vel augue vestibulum', 'Gloria Campbell', 'mi', 1, '8.57');
insert into productos (id, titulo, artista, genero, stock, precio) values (66, 'condimentum', 'Ralph Berry', 'tristique', 28, '2.05');
insert into productos (id, titulo, artista, genero, stock, precio) values (67, 'sit amet eros suspendisse', 'John Meyer', 'non mattis', 24, '6.74');
insert into productos (id, titulo, artista, genero, stock, precio) values (68, 'ut massa quis augue luctus', 'Samuel Graham', 'eget', 11, '4.23');
insert into productos (id, titulo, artista, genero, stock, precio) values (69, 'odio consequat varius integer', 'Betty Gray', 'nulla suscipit', 25, '7.03');
insert into productos (id, titulo, artista, genero, stock, precio) values (70, 'nulla pede ullamcorper augue a', 'Melissa George', 'volutpat', 3, '6.85');
insert into productos (id, titulo, artista, genero, stock, precio) values (71, 'varius integer ac leo pellentesque', 'Louis Gibson', 'at diam', 30, '3.23');
insert into productos (id, titulo, artista, genero, stock, precio) values (72, 'metus', 'Kimberly Pierce', 'at', 25, '1.42');
insert into productos (id, titulo, artista, genero, stock, precio) values (73, 'justo aliquam quis turpis eget', 'Frances Day', 'ipsum primis', 3, '1.92');
insert into productos (id, titulo, artista, genero, stock, precio) values (74, 'risus dapibus augue vel', 'Elizabeth Woods', 'sit amet', 17, '7.24');
insert into productos (id, titulo, artista, genero, stock, precio) values (75, 'lacus morbi quis tortor id', 'Andrea Stone', 'nibh fusce', 50, '7.17');
insert into productos (id, titulo, artista, genero, stock, precio) values (76, 'montes nascetur ridiculus', 'Louise James', 'urna pretium', 36, '3.99');
insert into productos (id, titulo, artista, genero, stock, precio) values (77, 'quis libero', 'Anna King', 'in', 15, '9.57');
insert into productos (id, titulo, artista, genero, stock, precio) values (78, 'ligula', 'Terry Gonzalez', 'adipiscing', 49, '4.38');
insert into productos (id, titulo, artista, genero, stock, precio) values (79, 'orci luctus et', 'Harry Woods', 'velit eu', 13, '2.08');
insert into productos (id, titulo, artista, genero, stock, precio) values (80, 'donec diam neque vestibulum', 'Jessica Parker', 'nulla', 10, '3.19');
insert into productos (id, titulo, artista, genero, stock, precio) values (81, 'est lacinia nisi venenatis tristique', 'Bruce Snyder', 'ac consequat', 19, '0.06');
insert into productos (id, titulo, artista, genero, stock, precio) values (82, 'laoreet ut rhoncus aliquet pulvinar', 'Carl Vasquez', 'blandit non', 27, '0.77');
insert into productos (id, titulo, artista, genero, stock, precio) values (83, 'quisque', 'Kimberly Carter', 'hac', 7, '1.92');
insert into productos (id, titulo, artista, genero, stock, precio) values (84, 'auctor gravida sem praesent id', 'Jack Cruz', 'enim', 9, '8.10');
insert into productos (id, titulo, artista, genero, stock, precio) values (85, 'mauris non ligula pellentesque ultrices', 'Raymond Alexander', 'orci eget', 22, '5.00');
insert into productos (id, titulo, artista, genero, stock, precio) values (86, 'eros suspendisse accumsan tortor', 'Phillip Johnson', 'libero ut', 27, '7.35');
insert into productos (id, titulo, artista, genero, stock, precio) values (87, 'in', 'Aaron Robertson', 'lectus in', 30, '1.54');
insert into productos (id, titulo, artista, genero, stock, precio) values (88, 'at', 'Barbara Weaver', 'ullamcorper augue', 36, '9.94');
insert into productos (id, titulo, artista, genero, stock, precio) values (89, 'id ligula suspendisse ornare consequat', 'Juan Morrison', 'rhoncus', 1, '9.20');
insert into productos (id, titulo, artista, genero, stock, precio) values (90, 'sit amet sem fusce consequat', 'Eric Harper', 'duis faucibus', 20, '0.12');
insert into productos (id, titulo, artista, genero, stock, precio) values (91, 'rutrum nulla nunc purus', 'Todd Pierce', 'lobortis', 14, '2.76');
insert into productos (id, titulo, artista, genero, stock, precio) values (92, 'volutpat', 'Willie Walker', 'in', 50, '3.94');
insert into productos (id, titulo, artista, genero, stock, precio) values (93, 'eu interdum', 'Joshua Brown', 'sed tristique', 35, '2.50');
insert into productos (id, titulo, artista, genero, stock, precio) values (94, 'sagittis sapien cum sociis natoque', 'Shawn Ferguson', 'vestibulum eget', 38, '4.43');
insert into productos (id, titulo, artista, genero, stock, precio) values (95, 'non pretium quis lectus suspendisse', 'Diana Barnes', 'consectetuer', 48, '1.28');
insert into productos (id, titulo, artista, genero, stock, precio) values (96, 'ac diam cras', 'Henry Simpson', 'vel accumsan', 26, '5.06');
insert into productos (id, titulo, artista, genero, stock, precio) values (97, 'augue', 'Bruce Olson', 'morbi', 15, '9.67');
insert into productos (id, titulo, artista, genero, stock, precio) values (98, 'elementum', 'Gregory Perry', 'sed', 37, '2.35');
insert into productos (id, titulo, artista, genero, stock, precio) values (99, 'et magnis dis parturient montes', 'Bonnie Ward', 'donec', 8, '9.67');
insert into productos (id, titulo, artista, genero, stock, precio) values (100, 'nulla', 'Justin Diaz', 'congue', 9, '5.10');


#
# Estructura tabla 'clientes'
#

DROP TABLE IF EXISTS clientes;
CREATE TABLE IF NOT EXISTS clientes (
  id int(4) NOT NULL auto_increment,
  user varchar(55) NOT NULL,
  password char(32) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


#
# Datos tabla'clientes'
#

#
# Estructura Tabla 'pedidos'
# FOREIGN KEY (id_equipo1) REFERENCES equipos(registro),

DROP TABLE IF EXISTS pedidos;
CREATE TABLE IF NOT EXISTS pedidos (
  id int(4) NOT NULL auto_increment,
  id_cliente int(4) NOT NULL,
  fecha date NOT NULL DEFAULT '0000-00-00' ,
  PRIMARY KEY (id),
  KEY id_cliente (id_cliente),
  FOREIGN KEY (id_cliente) REFERENCES clientes(id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


#
# Datos tabla 'pedidos'
#


#
# Estructura Tabla 'lineas_pedidos'
#

DROP TABLE IF EXISTS lineas_pedidos;
CREATE TABLE IF NOT EXISTS lineas_pedidos (
  id int(4) NOT NULL auto_increment,
  id_pedido int(4) NOT NULL,
  id_producto int(4) NOT NULL,
  PRIMARY KEY (id),
  KEY id_pedido (id_pedido),
  KEY id_producto (id_producto),
  FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
  FOREIGN KEY (id_producto) REFERENCES productos(id)
) CHARACTER SET utf8 COLLATE utf8_general_ci;


#
# Datos tabla 'pedidos'
#