CREATE DATABASE registro_visitas;

USE registro_visitas;

CREATE TABLE visitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NOT NULL,
    referer TEXT,
    visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
