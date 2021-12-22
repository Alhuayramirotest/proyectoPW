-- CREATE DATABASE registro_tarea;
-- use reg_tarea;

-- creando tabla para registrar usuarios 
CREATE TABLE Usuarios (
  dni int(8) NOT NULL primary key,
  Nombre varchar(45) NOT NULL,
  Apellidos varchar(45) NOT NULL,
  Username varchar(45) NOT NULL,
  Password varchar(255) NOT NULL
);

-- creando tabla para registra tareas 
CREATE TABLE Reg_tareas (
  id int (2) NOT NULL primary key,
  Titulo varchar(200) NOT NULL,
  Contenido varchar(500) NOT NULL,
  Fecha_registro date NOT NULL,
  Fecha_vencimiento date NOT NULL,
  dni int(8) NOT NULL,
  FOREIGN KEY (dni) REFERENCES Usuarios(dni)
);