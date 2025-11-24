-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS registros_diarios
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE registros_diarios;

-- Creación de la tabla principal
CREATE TABLE IF NOT EXISTS registro (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE NOT NULL,
  actividad VARCHAR(120) NOT NULL,
  descripcion TEXT NULL,
  horas DECIMAL(5,2) NOT NULL DEFAULT 0,
  responsable VARCHAR(80) NOT NULL,
  observaciones TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
