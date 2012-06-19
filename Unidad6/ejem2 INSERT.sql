# Introducir registros en las tablas productos y  
# proveedores de la base almacen. 

# Abrimos la base de datos 
USE almacen; 

# Introducimos tres registros en la tabla productos 
INSERT INTO productos  
VALUES (0,"Pala",10.55,100,"S","2001-12-16","Fuerte y barata"); 
INSERT INTO productos VALUES (0,"Azadón",20.21,50,"S",NOW(),"Se vende muy bien"); 
INSERT INTO productos VALUES (0,"Cuerda de pita 100 metros",3.98,75,"N",CURRENT_DATE,"Resistente y suave"); 

# Introducimos dos registros en la tabla proveedores 
INSERT INTO clientes VALUES (0,"Juan García",CURRENT_DATE,NULL,100.123,200.456,"Normal","Poco solvente"); 
INSERT INTO clientes VALUES (0,"Inés Fernández",CURRENT_DATE,NULL,1000.123,500.456,"Especial","Seguir los pagos"); 

# Introducimos otro registro en la tabla proveedores pero  
# sin incluir el campo "Tipo" para aparezca el valor por defecto. 
INSERT INTO clientes (nombre, alta, comprado_euros, notas) VALUES ("Delos, S.A.",CURRENT_DATE,1000000.000,"Buen proveedor"); 

# Introducimos dos registros en la tabla compras 
INSERT INTO compras VALUES (0, 1, 1, 10); 
INSERT INTO compras VALUES (0, 2, 1, 8); 
INSERT INTO compras VALUES (0, 3, 2, 5);