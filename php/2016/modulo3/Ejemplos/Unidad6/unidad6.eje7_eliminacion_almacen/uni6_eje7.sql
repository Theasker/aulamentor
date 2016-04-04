# Borrar tablas y bases de datos

# Abrimos la base de datos.

USE almacen;

# Mostramos todas las bases de datos.

SHOW DATABASES;

# Mostramos todas las tablas de la base de datos almacen.

SHOW TABLES;

# Eliminamos la tabla productos.

DROP TABLE IF EXISTS productos;

# Mostramos ahora las tablas de la base de datos almacen.

SHOW TABLES;

# Eliminamos la tabla clientes.

DROP TABLE IF EXISTS clientes;

# Mostramos ahora las tablas de la base de datos almacen.

SHOW TABLES;  

# Eliminamos la tabla compras.

DROP TABLE IF EXISTS compras;

# Mostramos ahora las tablas de la base de datos almacen.

SHOW TABLES;  /* Aquí no se muestra ya nada. */


# Mostramos todas las bases de datos.

SHOW DATABASES;

# Finalmente, eliminamos la base de datos almacen.

DROP DATABASE IF EXISTS almacen;

# Mostramos todas las bases de datos.

SHOW DATABASES;
