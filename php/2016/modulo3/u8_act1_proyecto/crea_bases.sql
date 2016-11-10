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