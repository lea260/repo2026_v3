-- Eliminar base de datos si ya existe
DROP DATABASE IF EXISTS concesionaria;

-- Crear base de datos
CREATE DATABASE concesionaria;
USE concesionaria;

-- Eliminar tablas si existen (por si ejecutás esto dentro de otra BD)
DROP TABLE IF EXISTS venta;
DROP TABLE IF EXISTS reserva;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS auto;

-- Crear tabla auto
CREATE TABLE auto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patente VARCHAR(7) NOT NULL UNIQUE,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    estado ENUM('disponible', 'reservado', 'vendido') NOT NULL DEFAULT 'disponible',
    version INT NOT NULL DEFAULT 0
);

-- Crear tabla usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) UNIQUE NOT NULL
);

-- Crear tabla reserva
CREATE TABLE reserva (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_auto INT NOT NULL,
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    FOREIGN KEY (id_auto) REFERENCES auto(id),
    UNIQUE (id_auto)
);

-- Crear tabla venta
CREATE TABLE venta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_auto INT NOT NULL,
    id_vendedor INT NOT NULL,
    fecha_venta DATETIME DEFAULT CURRENT_TIMESTAMP,
    precio DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_auto) REFERENCES auto(id),
    FOREIGN KEY (id_vendedor) REFERENCES usuario(id)
);

INSERT INTO auto (patente, marca, modelo, estado)
VALUES 
('ABC1234', 'Toyota', 'Corolla', 'disponible'),
('DEF4567', 'Honda', 'Civic', 'reservado'),
('GHI6789', 'Ford', 'Focus', 'vendido'),
('JKL3210', 'Chevrolet', 'Onix', 'disponible'),
('MNO6543', 'Volkswagen', 'Gol', 'disponible');

INSERT INTO usuario (nombre, correo_electronico)
VALUES 
('Juan Pérez', 'juan.perez@example.com'),        -- id = 1
('María López', 'maria.lopez@example.com'),      -- id = 2
('Carlos Díaz', 'carlos.diaz@example.com'),      -- id = 3
('Ana Torres', 'ana.torres@example.com');        -- id = 4

INSERT INTO reserva (id_usuario, id_auto)
VALUES 
(1, 2);

INSERT INTO venta (id_auto, id_vendedor, precio)
VALUES 
(3, 3, 35000.00);
