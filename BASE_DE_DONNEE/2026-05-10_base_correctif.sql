DROP DATABASE regime;

CREATE DATABASE IF NOT EXISTS regime;
USE regime;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    password VARCHAR(255)
);

CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    mot_de_passe VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    genre ENUM('Homme', 'Femme', 'Autre'),
    gold BOOLEAN DEFAULT FALSE
);

CREATE TABLE sante_utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    taille DECIMAL(5,2),
    poids DECIMAL(5,2),
    date_mesure TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_sante_utilisateur_utilisateur
    FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id)
    ON DELETE CASCADE
);

CREATE TABLE objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

CREATE TABLE utilisateur_objectif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_objectif INT NOT NULL,
    date_choix TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_utilisateur_objectif_utilisateur
    FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id)
    ON DELETE CASCADE,

    CONSTRAINT fk_utilisateur_objectif_objectif
    FOREIGN KEY (id_objectif)
    REFERENCES objectif(id)
    ON DELETE CASCADE
);

CREATE TABLE regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    pourcentage_viande DECIMAL(5,2),
    pourcentage_poisson DECIMAL(5,2),
    pourcentage_volaille DECIMAL(5,2),
    variation_poids DECIMAL(5,2),
    duree_jour INT,
    prix DECIMAL(10,2)
);

CREATE TABLE activite_sportive (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    variation_poids DECIMAL(10,2),
    duree INT
);


CREATE TABLE portefeuille (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    solde DECIMAL(10,2) DEFAULT 0,

    CONSTRAINT fk_portefeuille_utilisateur
    FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id)
    ON DELETE CASCADE
);

CREATE TABLE code_rechargement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100) UNIQUE,
    montant DECIMAL(10,2),
    status ENUM('valide', 'utilise') DEFAULT 'valide'
);

CREATE TABLE rechargement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_portefeuille INT NOT NULL,
    id_code INT NOT NULL,
    date_rechargement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_rechargement_portefeuille
    FOREIGN KEY (id_portefeuille)
    REFERENCES portefeuille(id)
    ON DELETE CASCADE,

    CONSTRAINT fk_rechargement_code
    FOREIGN KEY (id_code)
    REFERENCES code_rechargement(id)
    ON DELETE RESTRICT
);

CREATE TABLE achat_regime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_regime INT NOT NULL,
    prix_paye DECIMAL(10,2),
    date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_achat_regime_utilisateur
    FOREIGN KEY (id_utilisateur)
    REFERENCES utilisateur(id)
    ON DELETE CASCADE,

    CONSTRAINT fk_achat_regime_regime
    FOREIGN KEY (id_regime)
    REFERENCES regime(id)
    ON DELETE RESTRICT
);

ALTER TABLE utilisateur ADD COLUMN email VARCHAR(255) UNIQUE;
ALTER TABLE utilisateur_objectif ADD COLUMN poids DECIMAL(5,2);