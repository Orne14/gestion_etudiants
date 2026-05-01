CREATE DATABASE gestion_etudiants;

USE gestion_etudiants;

CREATE TABLE filieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    filiere_id INT,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id)
);