# Creamos la base de datos almacen si no existe.
CREATE DATABASE IF NOT EXISTS almacen;

# Abrimos la base de datos almacen
USE almacen;

# Creamos la tabla productos
CREATE TABLE IF NOT EXISTS 
productos( codigo INT PRIMARY KEY AUTO_INCREMENT,
	   nombre VARCHAR(30) NOT NULL,
	   precio_euros DECIMAL(8,3) DEFAULT 0.0 NOT NULL, 
	   stock TINYINT NOT NULL,
	   descuento SET('S','N')  DEFAULT "S" NOT NULL,
	   caduca DATE,notas TEXT);

# Creamos la tabla clientes
CREATE TABLE IF NOT EXISTS 
clientes( codigo INT PRIMARY KEY AUTO_INCREMENT,
          nombre VARCHAR(30) NOT NULL,
          alta DATETIME,
          baja DATETIME,
          comprado_euros DOUBLE NOT NULL,
          deudas_euros DOUBLE NOT NULL,
          tipo ENUM('Normal','Especial','Preferente') 
			DEFAULT "Normal" NOT NULL,
	  notas BLOB);

# Creamos la tabla compras
CREATE TABLE IF NOT EXISTS 
compras( codigo INT PRIMARY KEY AUTO_INCREMENT,
	 codigo_cliente INT NOT NULL,
	 codigo_producto INT NOT NULL,
	 cantidad INT NOT NULL DEFAULT 0);
