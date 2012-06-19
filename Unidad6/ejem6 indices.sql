# Diversas sintaxis de la orden CREATE INDEX y DROP INDEX 

# Abrimos la base de datos. 
USE almacen; 

# Mostramos los �ndices asociados a la tabla clientes. 
SHOW INDEX FROM clientes; 

# Mostramos el campo nombre de la tabla clientes 
# sin haber creado el �ndice c_nombre. Los registros 
# est�n desordenados por nombre. 
SELECT nombre FROM clientes; 

# Creamos el �ndice c_nombre con la tabla clientes 
# ordenando sus registros por nombre. 
CREATE INDEX c_nombre on clientes(nombre); 

# Mostramos otra vez los �ndices asociados a la tabla clientes. 
SHOW INDEX FROM clientes; 

# Mostramos el campo nombre de la tabla clientes 
# despu�s de crear el �ndice c_nombre. Los registros 
# ahora est�n ordenados por nombre. 
SELECT nombre FROM clientes; 

# Finalmente, destruimos el �ndice c_nombre. 
DROP INDEX c_nombre ON clientes; 

# Mostramos los �ndices asociados a la tabla productos. 
SHOW INDEX FROM productos; 

# Mostramos el campo stock de la tabla productos 
# sin haber creado el �ndice p_stock. Los registros 
# est�n desordenados por stock. 
SELECT stock FROM productos; 

# Creamos el �ndice p_stock con la tabla productos 
# ordenando sus registros por el campo stock. 
CREATE INDEX p_stock on productos(stock); 

# Mostramos otra vez los �ndices asociados a la tabla productos. 
SHOW INDEX FROM productos; 

# Mostramos el campo stock de la tabla productos 
# despu�s de crear el �ndice p_stock. Los registros 
# ahora est�n ordenados por el campo stock. 
SELECT stock FROM productos; 

# Finalmente, destruimos el �ndice p_stock. 
DROP INDEX p_stock on productos; 