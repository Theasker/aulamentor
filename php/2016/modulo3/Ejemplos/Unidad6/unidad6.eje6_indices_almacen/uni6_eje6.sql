# Diversas sintaxis de la orden CREATE INDEX y DROP INDEX

# Abrimos la base de datos.

USE almacen;

# Mostramos los índices asociados a la tabla clientes.

SHOW INDEX FROM clientes;

# Mostramos el campo nombre de la tabla clientes
# sin haber creado el índice c_nombre. Los registros
# están desordenados por nombre.

SELECT nombre FROM clientes;

# Creamos el índice c_nombre con la tabla clientes
# ordenando sus registros por nombre.

CREATE INDEX c_nombre on clientes(nombre);

# Mostramos otra vez los índices asociados a la tabla clientes.

SHOW INDEX FROM clientes;

# Mostramos el campo nombre de la tabla clientes
# después de crear el índice c_nombre. Los registros
# ahora están ordenados por nombre.

SELECT nombre FROM clientes;

# Finalmente, destruimos el índice c_nombre.

DROP INDEX c_nombre ON clientes;

# Mostramos los índices asociados a la tabla productos.

SHOW INDEX FROM productos;

# Mostramos el campo stock de la tabla productos
# sin haber creado el índice p_stock. Los registros
# están desordenados por stock.

SELECT stock FROM productos;

# Creamos el índice p_stock con la tabla productos
# ordenando sus registros por el campo stock.

CREATE INDEX p_stock on productos(stock);

# Mostramos otra vez los índices asociados a la tabla productos.

SHOW INDEX FROM productos;

# Mostramos el campo stock de la tabla productos
# después de crear el índice p_stock. Los registros
# ahora están ordenados por el campo stock.

SELECT stock FROM productos;

# Finalmente, destruimos el índice p_stock.

DROP INDEX p_stock on productos;
