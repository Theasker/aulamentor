# Diversas sintaxis de la orden UPDATE

# Abrimos la base de datos.

USE almacen;

# Mostramos el campo stock de productos antes de modificarlo.

SELECT stock FROM productos;

# En la tabla productos sustituimos el valor 100
# de stock por el valor 120.

UPDATE productos SET stock = 120 WHERE stock=100;

# Mostramos el campo stock de productos después de modificarlo.

SELECT stock FROM productos;

# Mostramos los campos baja y deudas_euros de clientes
# antes de modificarlos.

SELECT baja,deudas_euros FROM clientes;

# Modificamos los campos baja y deudas_euros de todos
# los registros de clientes.

UPDATE clientes SET baja=now(),deudas_euros=deudas_euros*1.10;

# Mostramos los campos baja y deudas_euros de clientes
# después de modificarlos.

SELECT baja,deudas_euros FROM clientes;


