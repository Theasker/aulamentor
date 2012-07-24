# Diversas sintaxis de la orden DELETE 

# Abrimos la base de datos. 
USE almacen; 

# Mostramos todos los registros de la tabla cientes antes 
# de eliminar algún registro. 
SELECT * FROM clientes; 

# Eliminamos los registros que no tengan deudas tanto en la tabla 
# compras como en clientes. 
delete FROM compras  
   WHERE codigo_cliente IN (select codigo FROM clientes WHERE deudas_euros=0);
   
delete FROM clientes WHERE deudas_euros=0; 

# Mostramos ahora los registros que quedan. 
SELECT * FROM clientes; 

# Eliminación múltiple en registro que tiene el código 1 
# tanto en la tabla clientes como en compras. 
delete compras, clientes FROM compras, clientes  
WHERE clientes.codigo=1 and compras.codigo_cliente=clientes.codigo; 

# Mostramos ahora los registros que quedan. 
SELECT * FROM clientes; 

# Eliminamos todos los registros de la tabla. 
delete FROM clientes; 

# Mostramos la tabla clientes, que ya no tiene ningún registro. 
SELECT * FROM clientes;