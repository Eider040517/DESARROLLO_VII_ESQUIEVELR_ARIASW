CREATE DATABASE recetas_db;

USE recetas_db;

-- Tabla de usuarios
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255),               -- Ya no es NOT NULL
    google_id VARCHAR(100),
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);