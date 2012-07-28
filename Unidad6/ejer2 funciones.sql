# Abrimos la base de datos ejercicios 
USE ejercicios; 

# Actualizamos un registro de la base de datos 
UPDATE agenda SET notas="Esta nota es nueva", Telefono_oficina="1234567"  
WHERE registro=1; 

# Mostramos los registros introducidos 
SELECT * FROM agenda ORDER BY apellidos; 

# Borramos el registro modificado 
DELETE FROM agenda WHERE registro=1; 

# Mostramos los registros introducidos 
SELECT * FROM agenda; 
