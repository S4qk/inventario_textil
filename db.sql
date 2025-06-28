-- Estructura de la base de datos para inventario_textil

CREATE DATABASE IF NOT EXISTS inventario_textil;
USE inventario_textil;

-- Tabla de rollos de tela
CREATE TABLE IF NOT EXISTS `rollos` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_tela` VARCHAR(100) NOT NULL,
  `color` VARCHAR(50) NOT NULL,
  `largo` DECIMAL(8,2) NOT NULL,
  `fecha_ingreso` DATE NOT NULL
);

-- Tabla de ventas parciales
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rollo_id` INT NOT NULL,
  `metros_vendidos` DECIMAL(8,2) NOT NULL,
  `fecha_venta` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`rollo_id`) REFERENCES `rollos`(`id`) ON DELETE CASCADE
); 