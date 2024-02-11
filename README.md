Para correr este proyecto se debe descargar todo en una carpeta llamada "bienesraices", contenida en htdocs y desde la terminal de vsc correr el comando 
php -S localhost:3000.
Una vez en el proyecto se debe correr npm install para instalar la carpeta node_modules.
Este proyecto cuenta con una base de datos SQL a la cual se accede desde PHP.

La misma tiene la siguiente estructura:
Table: propiedades
Columns:
id int AI PK 
titulo varchar(45) 
precio decimal(10,2) 
imagen varchar(200) 
descripcion longtext 
habitaciones int 
wc int 
estacionamiento int 
creado date 
vendedores_id int

Table: usuarios
Columns:
id int AI PK 
email varchar(50) 
password char(60)

Table: vendedores
Columns:
id int AI PK 
nombre varchar(45) 
apellido varchar(45) 
telefono varchar(10)
